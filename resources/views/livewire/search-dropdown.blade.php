<div class="search position-relative">
    <form class="form-inline my-2 my-lg-0">
        <input  wire:model="query"  class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-danger my-2 my-sm-0" type="submit">Search</button>
    </form>
    <div class="position-absolute rounded  w-100 bg-dark"style="z-index: 99999999">

            @if(strlen($query) >= 2)
            <ul style="list-style: none">
                @if(!empty($result))
                    @foreach($result as $row)
                    <li class="border border-bottom-light">
                        <img src="{{asset('storage/'.$row['id'].'/'.$row['thumbnail'])}}" width="40px" alt="">
                        <a href="{{route('product.show',$row['slug'])}}" class="d-inline-block text-light ml-3">{{str_limit($row['name'],18)}}</a>
                    </li>
                     @endforeach
                @else
                    <p>Không có kết quả</p>
                @endif
            </ul>
            @endif


    </div>
</div>
