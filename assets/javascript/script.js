const menuHamburger = document.querySelector(".menu-hamburger");
const navLinks = document.querySelector(".nav-links");

menuHamburger.addEventListener("click", () => {
  navLinks.classList.toggle("mobile-menu");
});

// <?php if (!empty($_SESSION['success'])): ?>
// alert("<?php echo $_SESSION['success']; ?>");
// <?php unset($_SESSION['success']);endif;?>

// <?php if (!empty($_SESSION['erreur'])): ?>
// alert("<?php echo $_SESSION['erreur']; ?>");
// <?php unset($_SESSION['erreur']);endif;?>
