                                    @foreach ($file as $files)
                                        <tr>
                                            <td><a href="{{asset('file/'.$files->file_orignal_name)}}" target="_blank" >{{ $files->file_orignal_name }}</a></td>
                                            <td>{{ $files->uploaded_by }}</td>
                                            <td>{{ $files->created_at->setTimezone('Asia/Singapore')->format('j F Y  g:i a') }}
                                            </td>
                                            <td> <a href="{{ url('file/' . $files->file_orignal_name) }}" download class="link-normal">
                                                    <img src="{{ url('images/download_icon.svg') }}" alt="delete-icon">
                                                </a>
                                                <a href="javascript:void(0);" class="del_confirm"
                                                    data-id="{{ $files->id }}"><i class="fa-solid fa-trash ms-2"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach