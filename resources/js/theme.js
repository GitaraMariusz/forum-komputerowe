const fontSizeSelector = document.getElementById('fontSizeSelector');
const contrastButton = document.getElementById('contrastButton');
const body = document.body;

 const applyTheme = () => {
   const savedFontSize = localStorage.getItem('fontSize') || 'normal';
    const savedContrast = localStorage.getItem('contrast') === 'true';
    body.classList.remove('font-small', 'font-large', 'contrast');
    body.classList.add(`font-${savedFontSize}`);
    if (savedContrast) {
      body.classList.add('contrast');
    }

   fontSizeSelector.value = savedFontSize;
 };

 if(fontSizeSelector){
     fontSizeSelector.addEventListener('change', function() {
        const fontSize = this.value;
         localStorage.setItem('fontSize', fontSize);
          applyTheme();
       });
 }


   if(contrastButton){
    contrastButton.addEventListener('click', function() {
     const currentContrast = localStorage.getItem('contrast') === 'true';
       const newContrast = !currentContrast;
        localStorage.setItem('contrast', newContrast);
         applyTheme();
       });
  }
  if(body) {
       applyTheme();
   }