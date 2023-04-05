<html>
    <head>
        <style>
            a{
                text-decoration: none;
            }

            ul li{
                display: inline;
            }
        </style>
    </head>
    <body>
        <nav>
            <ul>
                @foreach($langs as $lang)
                    <li>
                        <a href="{{ route('category', ['lang' => $lang->short_name])}}">
                            {{ $lang->short_name}}
                        </a>
                    </li>
                @endforeach       
            </ul>
        </nav>
        <form action="{{ route('update') }}" method='POST'>
            <input type='hidden' value='{{ $langId }}' name='langId'>
            {{ csrf_field() }}
            @foreach($categories as $category)
            <div>
                <input type='text' name='category[{{ $category->id }}]' value='{{ $category->name }}'>
                <input type='text' value='{{ $category->parentCategoryLang?->name }}' disabled>
                @if($errors->any())
                    @foreach($errors->get('category.' . $category->id) as $error)
                        <div style='color:red'>{{ $error }}</div>
                    @endforeach
                @endif
            </div>
            @endforeach
            <button type='submit'>Update</button>
        </form>
    </body>
</html>