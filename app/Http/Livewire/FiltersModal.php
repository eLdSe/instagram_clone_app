<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use LivewireUI\Modal\ModalComponent;

class FiltersModal extends ModalComponent
{
    public $filters = ['Original', 'Clarendon', 'Gingham', 'Moon', 'Perpetua'];
    public $image;
    public $filtered_image;
    public $temp_images = [];
    public $description;

    protected $listeners = ['add_temp_image', 'modalClosed' => 'delete_temp_images'];

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public static function dispatchCloseEvent(): bool
    {
        return true;
    }

    public function mount($image)
    {
        $this->image = str_replace('\\', '/', $image);
        $this->filtered_image = $this->image;

        $this->ensureDirectories();

        $this->add_temp_image($this->image);
    }

 

    public function filter_original()
    {
        $this->filtered_image = $this->image;
        $this->emit('add_temp_image', $this->filtered_image);
    }

    public function filter_clarendon()
    {
        $this->applyFilter(fn($img) => $img->brightness(20)->contrast(15));
    }

    public function filter_moon()
    {
        $this->applyFilter(fn($img) => $img->brightness(10)->contrast(5)->greyscale());
    }

    public function filter_gingham()
    {
        $this->applyFilter(fn($img) => $img->brightness(20)->contrast(20)->colorize(0, -10, -10));
    }

    public function filter_perpetua()
    {
        $this->applyFilter(fn($img) => $img->contrast(-10)->colorize(-30, 10, 10));
    }



    private function applyFilter($callback)
    {
        $this->ensureDirectories();

        $filename = Str::random(30) . '.jpeg';
        $tempPath = 'temp/' . $filename;

        $fullPath = storage_path('app/public/' . $this->image);

        if (!file_exists($fullPath)) {
            dd('Исходный файл не найден: ' . $fullPath);
        }

        $img = Image::make($fullPath);
        $callback($img);

        // сохраняем через Storage
        Storage::disk('public')->put(
            $tempPath,
            (string) $img->encode('jpg', 90)
        );

        $this->filtered_image = $tempPath;

        $this->emit('add_temp_image', $this->filtered_image);
    }


    public function publish()
    {
        $this->validate([
            'description' => 'required',
        ]);

        $this->ensureDirectories();

        $post_image = 'posts/' . Str::random(30) . '.jpeg';

        $filtered = str_replace('\\', '/', $this->filtered_image);

        // 🔥 проверка существования
        if (!Storage::disk('public')->exists($filtered)) {
            dd('Файл для публикации не найден: ' . $filtered);
        }

        Storage::disk('public')->move($filtered, $post_image);

        auth()->user()->posts()->create([
            'description' => $this->description,
            'slug'        => Str::random(10),
            'image'       => $post_image,
        ]);

        $this->forceClose()->closeModal();
    }



    public function add_temp_image($image)
    {
        $this->temp_images[] = str_replace('\\', '/', $image);
    }

    public function delete_temp_images()
    {
        foreach ($this->temp_images as $img) {
            if (Storage::disk('public')->exists($img)) {
                Storage::disk('public')->delete($img);
            }
        }
    }


    private function ensureDirectories()
    {
        if (!Storage::disk('public')->exists('temp')) {
            Storage::disk('public')->makeDirectory('temp');
        }

        if (!Storage::disk('public')->exists('posts')) {
            Storage::disk('public')->makeDirectory('posts');
        }
    }


    public function render()
    {
        return view('livewire.filters-modal');
    }
}