const faqHeaders = document.querySelectorAll('.faq-header');

faqHeaders.forEach(header => {
  header.addEventListener('click', () => {
    const active = document.querySelector('.faq-header.active');
    if (active && active !== header) {
      active.classList.remove('active');
      active.nextElementSibling.style.display = 'none';
    }

    header.classList.toggle('active');
    const content = header.nextElementSibling;
    content.style.display = content.style.display === 'block' ? 'none' : 'block';
  });
});
