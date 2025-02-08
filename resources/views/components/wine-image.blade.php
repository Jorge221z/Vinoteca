@props(['wine'])

<img
class="w-full object-cover rounded-t-lg md:w-48 md:h-auto md:rounded-l-lg"
src="{{ $wine->image_url }}"
alt="{{ $wine->name }}">
