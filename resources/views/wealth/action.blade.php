<a  href="{{ route('wealth.show', $id) }}" title="View"><img src="{{asset('/images/visibility.png')}}" alt=""></a>

{{-- {!! Form::open(['method' => 'DELETE', 'route' => ['wealth.destroy', $id], 'style' => 'display:inline']) !!}
{!! Form::button('<i class="fa-solid fa-trash"></i>', ['type' => 'submit', 'class' => 'btn', 'title'=>"Delete"]) !!}
{!! Form::close() !!} --}}

<a href="javascript:void(0);" data-id={{$id}} title="Delete" class="btn del_confirm"><i class="fa-solid fa-trash"></i></a>