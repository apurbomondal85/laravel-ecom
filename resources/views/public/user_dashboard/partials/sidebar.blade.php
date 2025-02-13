<div class="col-lg-2">
    <ul class="account-nav">
      <li><a href="http://localhost:8000/account-dashboard" class="menu-link menu-link_us-s ">Dashboard</a></li>
      <li><a href="http://localhost:8000/account-orders" class="menu-link menu-link_us-s menu-link_active">Orders</a></li>
      <li><a href="http://localhost:8000/account-addresses" class="menu-link menu-link_us-s ">Addresses</a></li>
      <li><a href="http://localhost:8000/account-details" class="menu-link menu-link_us-s ">Account Details</a></li>
      <li><a href="http://localhost:8000/account-wishlists" class="menu-link menu-link_us-s ">Wishlist</a></li>
      <li>
        <form method="POST" action="http://localhost:8000/logout" id="logout-form-1">
            <input type="hidden" name="_token" value="3v611ELheIo6fqsgspMOk0eiSZjncEeubOwUa6YT" autocomplete="off">            <a href="http://localhost:8000/logout" class="menu-link menu-link_us-s" onclick="event.preventDefault(); document.getElementById('logout-form-1').submit();">Logout</a>
        </form>
    </li>
  </ul>          
</div>