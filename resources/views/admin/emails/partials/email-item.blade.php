@isset($email)
    <div class="col-lg-4 col-xl-3 mt-2">
        <a href="{{ route('admin.emails.show', $email) }}">
            <div class="small-box small-box--selectable bg-dark">
                <div class="inner col-lg-9">
                    <h5 style="font-size: 1.15rem;">{{ isset($title) ? $title : ucfirst(Str::slug($email, ' ')) }}</h5>
                </div>
                <div class="icon icon--small icon--email"><i class="fa fa-envelope"></i></div>
            </div>
        </a>
    </div>
@endisset
