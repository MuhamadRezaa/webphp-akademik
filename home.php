<div class="row mt-3">
    <h1>Welcome home, <?= $_SESSION['username'] ?></h1>
    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae officia error eos minima similique labore sit culpa dicta minus voluptatum, tenetur aut, possimus iure facilis sint accusamus obcaecati! Omnis, vel. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem laudantium id quo autem architecto fugiat qui ratione voluptatum in ex consectetur, dolor, nam, aliquid ab veniam perferendis inventore illum culpa!
    </p>
</div>

<h2>Berita</h2>
<div class="row">
    <?php
    $page=isset($_GET['page']) ? $_GET['page'] : 'home';
    switch ($page) {
        case 'detail':
            $sql=mysqli_query($db,"SELECT * FROM berita where id_berita='$_GET[id]'");
        $data=mysqli_fetch_array($sql); 
            $img=!empty($data['gambar']) ? $data['gambar'] : 'default.png';
   ?>
   <div class="col-10">
        <div class="card">
        <img src="admin/images/<?= $img ?>" class="img-fluid" height="300">
        <div class="card-body">
            <h5 class="card-title"><a href=""><?= $data['judul']?></a></h5>
            <p class="card-text"><?= $data['isi_berita']?></p>
            <a href="index.php" class="btn btn-primary">..Back</a>
        </div>
    </div>
    
    </div>
   <?php
            break;
        
        default:
    
    $sql=mysqli_query($db,"SELECT * FROM berita");
        while ($data=mysqli_fetch_array($sql)) { 
            $img=!empty($data['gambar']) ? $data['gambar'] : 'default.png';
    ?>
    <div class="col-4 mb-3">
        <div class="card">
        <img src="admin/images/<?= $img ?>" class="card-img-top" width="200" height="200">
        <div class="card-body">
            <h5 class="card-title"><a href="index.php?page=detail&id=<?= $data['id_berita'] ?>"><?= $data['judul']?></a></h5>
            <p class="card-text"><?= substr($data['isi_berita'], 0,200)?></p>
            <a href="index.php?page=detail&id=<?= $data['id_berita'] ?>" class="btn btn-primary">Read more...</a>
        </div>
    </div>
    
    </div>
    <?php
        }
    ?>
    <?php
            break;
    }
    ?>
        
</div>
