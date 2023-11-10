<div class="bg-blue-600 hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
    <div class="image-container">
     <img src="{{ asset('Assets/images/cover2.jpg') }}" alt="Gambar" class="image"> 
      <div class="overlay">
        <div id="welcome-text" class="text-white text-5xl mb-4">Selamat Datang di Sistem HAMKA BS</div>
   
      </div>
    </div>
  </div>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .image-container {
      position: relative;
      width: 100%;
      height: 0;
    }

    .image {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      object-fit: cover;
    }

    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
  </style>

 
