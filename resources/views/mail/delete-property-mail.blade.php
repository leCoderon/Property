<x-mail::message>
# {{$sub}}  | _{{now()}}_

{{-- Vous avez supprimé le bien avec _#id_: **{{$property->id}}** le {{now()}}. --}}
- Titre : **{{ $property->title }}**
- Prix  : {{ $property->price }} CFA
- Etat  : {{ $property->sold ? 'Vendu' : 'Invendu' }}

 
**Description :** 
    <br>
    {{ $property->description }}

## Consulter  <a href="{{route('admin.property.index')}}">la liste des bien disponibles</a>
</x-mail::message>
