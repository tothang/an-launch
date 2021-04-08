<a href="{{ route('wordclouds.show', $wordcloud->id) }}">
    <div class="menu-item">
        <div class="container">
            <div class="row">
                <div class="col-xs-9 vcenter">
                    <div class="menu-item-title">{{ $wordcloud->title }}</div>
                    <div class="menu-item-description">{{ $wordcloud->description }}</div>
                </div>
                <div class="col-xs-3 vcenter text-center">
                    <i class="fa fa-angle-right fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
</a>
