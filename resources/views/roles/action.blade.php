<a class="btn" href="{{ route('roles.show', $id) }}" title="View">
    <i class="fa-solid fa-eye"></i>
</a>

{{-- {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $id], 'style' => 'display:inline']) !!}
{!! Form::button('<i class="fa-solid fa-trash"></i>', ['type' => 'submit', 'class' => 'btn']) !!}
{!! Form::close() !!} --}}

<a class="btn del_confirm" href="javascript:void(0)" title="Delete" data-id={{$id}}>
    <i class="fa-solid fa-trash"></i>
</a>