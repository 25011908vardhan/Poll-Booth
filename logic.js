var showpass=document.getElementById('show');
var pass=document.getElementById('pass');
var cpass=document.getElementById('cpass');
showpass.addEventListener('click',()=>
{
if(pass.type==='password')
{
    pass.type='text';
    cpass.type='text';
    showpass.src="eyeopenN.png";
}
else
{
    pass.type='password';
    cpass.type='password';
    showpass.src="eyecloseN.png";
}
});
