@foreach ($posts as $post)
    <x-post.post :post="$post" :clickable="true"/>
@endforeach
