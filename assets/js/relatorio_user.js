document.addEventListener("DOMContentLoaded", function() {
    const accordionItems = document.querySelectorAll('.accordion .link');
    const periodoAccordionItems = document.querySelectorAll('.periodo .periodo_report');
    const usersAccordionItems = document.querySelectorAll('#user_relatorio .user-report');
  
    function toggleSubmenu(submenu) {
        submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
    }
  
    accordionItems.forEach(item => {
        item.addEventListener('click', function() {
            const submenu = this.nextElementSibling;
            toggleSubmenu(submenu);
        });
    });
  
    periodoAccordionItems.forEach(item => {
        item.addEventListener('click', function() {
            const submenu = this.nextElementSibling;
            toggleSubmenu(submenu);
        });
    });
  
    usersAccordionItems.forEach(item => {
        item.addEventListener('click', function() {
          const submenu = this.nextElementSibling;
          toggleSubmenu(submenu);
        });
    });
  });
  
  const ctx = document.getElementById('myChart');
      
      new Chart(ctx, {
      type: 'doughnut',
      data: {
          labels: ['Não Conforme', 'Conforme', 'Intervenção'],
          datasets: [{
          data: [countNC, countC, countCorrecao],
          backgroundColor: ['#CB1010','#609437' ,'#F3B33D' ],
          borderWidth: 1
          }]
      },
      });
  
  
  const ct = document.getElementById('Chart');
            
      new Chart(ct, {
        type: 'bar',
        data: {
          labels: ['Não Conforme', 'Conforme', 'Intervenção'],
          datasets: [{
            label: 'Vizualizar quantidade',
            data: [countNC, countC, countCorrecao],
            backgroundColor: ['#CB1010','#609437' ,'#F3B33D' ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
  
  
  var xhr = new XMLHttpRequest();
  
$('#select_user').on('change',(e)=>{

  console.log(e.target.value)

})
  
  
  
  