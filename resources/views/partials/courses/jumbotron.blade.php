<div class="row">
    <div class="col-md-12">
        <div class="card pt-5" style="background-image: url('{{ url('/images/jumbotron.png') }}')">
            <div class="text-white text-center d-flex align-items-center py-5 px-4 my-5" >
                <div class="col-5">
                    <img class="img-fluid" src="{{$course->pathAttachment() }}" />
                </div>
                <div class="col-5 text-left">
                    <h1>{{__("Curso")}} : {{$course->name}}</h1>
                    <h4>{{__("Profesor")}} : {{$course->teacher->user->name}}</h4>
                    <h4>{{__("Categoria")}} : {{$course->category->name}}</h4>
                    <h5>{{__("Fecha de publicacion")}} : {{$course->created_at->format('d/m/Y')}}</h5>
                    <h5>{{__("Fecha de actualizacion")}} : {{$course->updated_at->format('d/m/Y')}}</h5>
                    <h6>{{__("Estudiantes Inscriptos")}} : {{$course->students_count}}</h6>
                    <h6>{{__("Numero de valoraciones")}} : {{$course->reviews_count}}</h6>
                </div>

                @include('partials.courses.action_button')
            </div>
        </div>
    </div>
</div>