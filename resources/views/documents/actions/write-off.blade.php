<a id="process_manually" class="btn btn-green">
    Опрацювати
</a>


@section('page-script')
    @parent
    <script>
        var documentId = {!! $document->id !!};
    </script>

    <script src="{{asset('assets/js/entity/document/document-actions/write-off.js')}}"></script>
@endsection


