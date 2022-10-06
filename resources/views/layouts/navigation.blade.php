<nav class="navbar is-primary" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="/projects">
           <h1 class="is-size-4 is-italic">MyProjects</h1>
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            @auth
            <a class="navbar-item" href="/projects">
                Home
            </a>

            <a class="navbar-item" href="/profile">
                Profile
            </a>
                @endauth
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    @guest()
                    <a class="button is-primary" href="/register">
                        <strong>Sign up</strong>
                    </a>
                    <a class="button is-light" href="/login">
                        Log in
                    </a>
                    @endguest
                    @auth
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button type="submit" class="button is-light">sign out</button>

                            </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
