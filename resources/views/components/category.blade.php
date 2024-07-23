<div class="accordion-item category-data {{$category->isChild() ? 'border-0': '' }} ">
    <h2 class="accordion-header accordion-header-custom-goods d-flex align-items-center" id="heading{{$category->id}}">
        <button
            class="accordion-button {{$category->children->isEmpty() ? 'accordion-button-custom-empty ps-3' : 'accordion-button-custom'}} collapsed {{$category->isChild() ? 'pe-2' : 'px-2'}}"
            type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$category->id}}"
            data-id="{{$category->id}}"
            data-name="{{$category->name}}"
            data-parent="{{$category->parent_id}}"
            aria-expanded="true" aria-controls="collapse{{$category->id}}"
            {{$category->isChild() ? 'style=padding-left:' . $i . 'rem;' : '' }}
        >
       <span class="d-flex flex-grow-1 justify-content-between">
                <span class="fw-bolder">{{$category->name }}</span>

            </span>
        </button>
        <div class="gap-1 d-flex accordion-button-custom-action align-items-center pe-2" style="height: 50px">
                    <span data-bs-toggle="modal" id="add_category_goods_button"
                          data-bs-target="#add_category_goods" type="submit"
                          class="px-25">
                        <img src="{{asset('assets/icons/entity/type-goods/plus.svg')}}"
                             alt="plus">
                    </span>
            <span data-bs-toggle="modal" id="edit_category_goods_button"
                  data-bs-target="#edit_category_goods" type="submit"
                  class="px-25">
                        <img src="{{asset('assets/icons/entity/type-goods/edit.svg')}}"
                             alt="edit">
                     </span>
        </div>
    </h2>
    <div id="collapse{{$category->id}}" class="accordion-collapse collapse"
         aria-labelledby="heading{{$category->id}}" data-bs-parent="#accordion{{$category->id}}">
        <div class="accordion" id="accordion{{$category->id}}">
            @if( !$category->children->isEmpty())
                <div class="accordion-body p-0">
                    @php( $i += 1 )
                    @if( !$category->children->isEmpty())
                        <x-categories :categories="$category->children" :i="$i"></x-categories>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

