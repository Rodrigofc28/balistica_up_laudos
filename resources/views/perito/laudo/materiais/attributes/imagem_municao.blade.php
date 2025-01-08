
<label  class="upImage" for="upImage">
            
    <b >FOTO BASE</b>
    <input hidden  type="file" name="up_image" accept=".jpg,.png,.jpeg" id="upImage">
    <div >
        
        <img   src="{{asset('image\bullets.png')}}" alt="upload de imagem">
        <img style="display: none" id="verificador" src="{{asset('image\verificar.png')}}" alt="">
    </div>
    
</label>
<label  class="upImage" for="upImage2">
    
    <b >FOTO LATERAL</b>
    <input hidden  type="file" name="up_image2" accept=".jpg,.png,.pdf" id="upImage2">
    <div >
        
        <img   src="{{asset('image\bullets.png')}}" alt="upload de imagem">
        <img style="display: none" id="verificador2" src="{{asset('image\verificar.png')}}" alt="">
    </div>
    
</label>


