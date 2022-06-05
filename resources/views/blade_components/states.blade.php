
    <section class="section pt-5 pb-5 products-section">
        <div class="container">
            <div class="section-header text-center">
                <h2>PROVIENCE</h2>
                <p>Browse Restaurant By Provience</p>
                <span class="line"></span>
            </div>
            <div class="row">
                @forelse($states as $st)
                    <div class="col-md-3 mb-3">
                        <a href="{{route('restaurantlisting',$st->id)}}">
                        <div class="card">
                            <div class="card-body text-center">
                                    <h6 class="card-title">{{$st->name}}</h6>
                                    <div class="text-primary">Total Restaurant: {{$st->restaurants->count()}}</div>
                            </div>
                        </div>
                        </a>
                    </div>
                @empty
                <p class="text-center text-primary">No Restaurant Found</p>
                @endforelse
            </div>
        </div>
    </section>