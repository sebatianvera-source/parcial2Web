<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">

    <a class="navbar-brand" href="/26-ACN2BV-veraBenitez-sebastian-parcial2/index.php">
      <img src="/26-ACN2BV-veraBenitez-sebastian-parcial2/recursos/logoBullpadel.png" alt="Logo Bullpadel" class="d-none d-md-block">
      <img src="/26-ACN2BV-veraBenitez-sebastian-parcial2/recursos/logoBullpadelMobile.png" alt="Logo Mobile Bullpadel" class="d-md-none">
    </a>


    <div class="d-flex align-items-center gap-3 ms-auto order-lg-3">


      <a
        href="/26-ACN2BV-veraBenitez-sebastian-parcial2/paginas/carrito.php"
        class="nav-link d-flex align-items-center"
        aria-label="Carrito"
        title="Carrito"
      >
        <span class="material-symbols-outlined">shopping_cart</span>
      </a>


      <a
        href="/26-ACN2BV-veraBenitez-sebastian-parcial2/paginas/login.php"
        class="nav-link d-flex align-items-center"
        aria-label="Ingresar"
        title="Ingresar"
      >
        <span class="material-symbols-outlined">account_circle</span>
      </a>


      <form
        action="/26-ACN2BV-veraBenitez-sebastian-parcial2/acciones/cambiar-tema.php"
        method="POST"
        class="m-0"
      >
        <input
          type="hidden"
          name="volver"
          value="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>"
        >
        <button
          type="submit"
          class="btn btn-outline-secondary d-flex align-items-center"
          aria-label="Cambiar tema"
          title="Cambiar tema"
        >
          <span class="material-symbols-outlined">
            <?= $tema === 'dark' ? 'light_mode' : 'dark_mode' ?>
          </span>
        </button>
      </form>

    </div>

    <button
      class="navbar-toggler ms-3 order-lg-2"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Abrir menú"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-lg-1" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link" href="/26-ACN2BV-veraBenitez-sebastian-parcial2/index.php">
            Inicio
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/26-ACN2BV-veraBenitez-sebastian-parcial2/paginas/productos/productos.php">
            Productos
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/26-ACN2BV-veraBenitez-sebastian-parcial2/paginas/contacto/contacto.php">
            Contacto
          </a>
        </li>

      </ul>

      <form
        class="d-flex flex-grow-1 my-2 my-lg-0 me-lg-3"
        role="search"
        action="/26-ACN2BV-veraBenitez-sebastian-parcial2/paginas/productos/productos.php"
        method="GET"
      >
        <div class="input-group">
          <input
            class="form-control"
            type="search"
            name="buscar"
            placeholder="Buscar productos..."
            aria-label="Buscar productos"
          >

          <button
            class="btn btn-outline-secondary d-flex align-items-center"
            type="submit"
            aria-label="Buscar"
          >
            <span class="material-symbols-outlined">search</span>
          </button>
        </div>
      </form>
    </div>

  </div>
</nav>