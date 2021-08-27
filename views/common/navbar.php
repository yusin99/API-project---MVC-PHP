<!-- Header -->
<header id="header">
    <a href="index" class="title">Hyperspace</a>
    <nav>
        <ul>
            <li><a href="<?= URL ?>index" class="<?= str_contains(FULL_URL, "index") || str_contains(FULL_URL, "home") ? "active" : "" ?>">Home</a></li>
            <li><a href="<?= URL ?>generic2" class="<?= str_contains(FULL_URL, "generic") ? "active" : "" ?>">Generic</a></li>
            <li><a href="<?= URL ?>elements"  class="<?= str_contains(FULL_URL, "elements") ? "active" : "" ?>">Elements</a></li>
            <li><a href="<?= URL ?>allusers"  class="<?= str_contains(FULL_URL, "allusers") ? "active" : "" ?>">Users</a></li>
        </ul>
    </nav>
</header>