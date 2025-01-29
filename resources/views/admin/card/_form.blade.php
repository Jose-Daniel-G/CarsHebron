@csrf
<label for="titulo" class="uppercase text-gray-700 text-xs">Titulo</label>
<input type="text" name="title" id="title" class="rounded border-gray-200 w-full mb-4" value="{{ $card->title}}">
<label for="titulo" class="uppercase text-gray-700 text-xs">Contenido</label>
<textarea name="body" rows="5" class="rounded border-gray-200 w-full mb-4">{{ $card->body}}</textarea>\

<div class="flex justify-center items-center">
    <a href="{{ route('card.index')}}" class="text-indigo-600">Volver</a>
    <input type="submit" value="Enviar" class="bg-gray-800 text-withe rounded px-4 py-2">
</div>