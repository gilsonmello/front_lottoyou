<p>{{ trans('strings.name')  }}: {{ $contact->name  }}</p>
<p>{{ trans('strings.email')  }}: {{ $contact->email  }}</p>
<p>{{ trans('strings.category')  }}: {{ $contact->category->name  }}</p>
<br>
<p>{{ $contact->description }}</p>