@extends('theme.default')
@section('head')
<link rel="stylesheet" href="{{ "theme/vendor/datatables/dataTables.bootstrap4.min.css" }}">
@endsection
@section('heading')
عرض الكتب 
@endsection
@section("content")
<a class="btn btn-primary" href="{{ route("books.create") }}"><i class="fa fa-plus"></i>أضف كتاب جديد </a>
<hr>
<table id="books-table" class="table table-stribed text-right width="100%" collspacing="0">
    <thead>
        <tr>
            <th>العنوان</th>
            <th>الرقم التسلسلي</th>
            <th>التصنيف</th>
            <th>المؤلفون</th>
            <th>الناشر</th>
            <th>السعر</th>
            <th>خيارات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
        <tr>
            <td><a href="{{ route("books.show" , $book) }}">{{ $book->title }}</a></td>
            <td>{{ $book->isbn }}</td>
            <td> {{ $book->category != null ? $book->category->name : ""}}</td>
            <td>
                @if ($book->authors()->count() > 0)
                    @foreach ($book->authors as $author)
                        {{ $loop->first ? "" : "و"}}
                        {{ $author->name}}
                    @endforeach
                @endif
            </td>
            <td> {{ $book->publisher != null ? $book->publisher->name : ""}}</td>
            <td>{{ $book->price }}$</td>
            <td>
            <a class="btn btn-info btn-sm" href="{{ route('books.edit', $book) }}"><i class="fa fa-edit"></i> تعديل</a> 
            <form class="d-inline-block" method="POST" action="{{ route('books.destroy', $book) }}">
                    @method('delete')
                    @csrf
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')"><i class="fa fa-trash"></i> حذف</button> 
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
@endsection
@section('script')
<!-- Page level plugins -->
<script src="{{ asset('theme/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('theme/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#books-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
            }
        });
    });
</script>
@endsection