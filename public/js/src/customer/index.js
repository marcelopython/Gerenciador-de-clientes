

$('.btn-remove-customer').click((event)=>{
    if(confirm('Deseja realmente remover o cliente?').valueOf()){
        let target = event.target;
        if(target.nodeName === 'I'){
            target = target.parentNode;
        }
        target.form.submit()
    }
});