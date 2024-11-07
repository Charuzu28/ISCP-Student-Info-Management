const outerContainer = document.querySelector('.outer-container');
const addButton = document.querySelector('.add-button');

addButton.addEventListener('click', function(){
    if(outerContainer.style.display != 'initial'){
        outerContainer.style.display = 'initial';
    }
})

const closeModal = document.querySelector('.close-modal');

closeModal.addEventListener('click',function(){
    if(outerContainer.style.display == 'initial'){
        outerContainer.style.display = 'none';
    }
})
