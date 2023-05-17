<a href="{{ route('users.show', $id) }}" title="View" class="btn"><i class="fa-solid fa-eye"></i></a>

    {{-- <img src="{{ asset('/images/visibility.png') }}" alt=""> --}}
{{-- {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $id], 'style' => 'display:inline']) !!}
{!! Form::button('<i class="fa-solid fa-trash"></i>', ['type' => 'button', 'class' => 'btn del_confirm', 'title'=>"Delete"]) !!}
{!! Form::close() !!} --}}

<a href="javascript:void(0);" data-id={{$id}} title="Delete" class="btn del_confirm"><i class="fa-solid fa-trash"></i></a>
