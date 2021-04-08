<button
    role="button"
    title="Click here to open the Menu"
    id="menu-button"
    class="btn btn--primary sidebar__btn"
    onClick="sidebarOpen('sidebarOpen')"
>
    <span class='__text'>Menu</span>
</button>

<div id="sidebar" class="sidebar sidebar--hidden">
    <header class="sidebar__header">
        <img class="sidebar__logo" src="img/logos/drpg-logo-ash.png" alt="Logo"  />
        <button class="sidebar__close" id="sidebarClose">
        </button>
    </header>
    <ul class="sidebar__list">
        <li class="sidebar__list-item">
            <a href={{ url('experience#media-name=foyer') }} class="sidebar__link">Home</a>
        </li>
        <li class="sidebar__list-item">
            <a href={{ url('experience#media-name=expo') }} class="sidebar__link">Expo</a>
        </li>
        <li class="sidebar__list-item">
            <a href={{ url('experience#media-name=auditorum') }} class="sidebar__link">auditorum</a>
        </li>
        <li class="sidebar__list-item">
            <a href={{ url('experience#media-name=breakoutOne') }} class="sidebar__link">breakout 1</a>
        </li>
        <li class="sidebar__list-item">
            <a href={{ url('experience#media-name=breakoutTwo') }} class="sidebar__link">breakout 2</a>
        </li>
        <li class="sidebar__list-item">
            <a href={{ url('experience#media-name=breakoutThree') }} class="sidebar__link">breakout 3</a>
        </li>
    </ul>
    <footer class="sidebar__footer">
        <a href={{ route('holding') }} class="sidebar__link">Back to site</a>
    </footer>
</div>

<script>
    const button = document.getElementById('menu-button')
    const sidebar = document.getElementById('sidebar')
    const sidebarClose = document.getElementById('sidebarClose')

    function sidebarOpen() {
        sidebar.classList.remove('sidebar--hidden')
    }

    sidebarClose.addEventListener("click", function() {
        sidebar.classList.add('sidebar--hidden')
    });
</script>
