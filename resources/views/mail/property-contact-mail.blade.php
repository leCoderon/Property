<x-mail::message>
# Nouvelle prise de contact 

Une nouvelle demande de contact a été effectuer pour le bien <a href="{{ route('property.show', ['slug' => $property->getSlug(), 'property' => $property]) }}">{{ $property->title }}</a>.

- _Prénom_ : {{ $userData['name'] }}
- _Nom_ : {{ $userData['surname'] }}
- _Telephone_ : {{ $userData['phone'] }}
- _Email_ : {{ $userData['email'] }}

**Message :** 
    <br>
    {{ $userData['message'] }}

</x-mail::message>
