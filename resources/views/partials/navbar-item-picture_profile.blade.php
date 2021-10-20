<a href="{{ url($link) }}" class="navbar-item  {{ request()->is($link) ? 'is-active' : '' }}">
    <table>
        <tr>
            <td>
                <figure class="image is-24x24">
                    <img class="is-rounded" src="/storage/avatars/{{ auth()->user()->avatar ?? 'default_avatar.png' }}" alt="Avatar">
                </figure>
            </td>
            <td>
                &nbsp{{ $label }}
            </td>
        </tr>
    </table>
</a>
