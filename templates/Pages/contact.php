<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Liên Hệ</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $this->Url->build('/', ['fullBase' => true]); ?>">Trang Chủ</a></li>
                    <li class="breadcrumb-item active">Liên Hệ</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="contact-box-main">
    <div class="content">
    
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10">
          

          <div class="row justify-content-center">
            <div class="col-md-6">
              
              <h3 class="heading-contact mb-4">LIÊN HỆ VỚI CHÚNG TÔI</h3>
              <p>Giử yêu cầu hỗ trợ hoặc cho chúng tôi biết về trải nghiệm của quý khách hàng</p>

              <p><img src="<?php echo $this->Url->webroot('images/undraw-contact.svg'); ?>" alt="Image" class="img-fluid"></p>


            </div>
            <div class="col-md-6">
              <form class="mb-5" method="post" id="contactForm" name="contactForm">
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control contact-field" name="name" id="name" placeholder="Họ Tên">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control contact-field" name="email" id="email" placeholder="Email">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control contact-field" name="phone" id="phone" placeholder="Số Điện Thoại">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <textarea class="form-control contact-field" style="height: auto;" name="message" id="message" cols="30" rows="7" placeholder="Nội Dung"></textarea>
                  </div>
                </div>  
                <div class="row">
                  <div class="col-12">
                    <input type="submit" value="Gửi" class="btn btn-primary rounded-0 py-2 px-4 btn-contact">
                  <span class="submitting_contact"></span>
                  </div>
                </div>
              </form>
               <div id="form-message-success">
                    <h2> Thông tin của quý khác hàng đã được gửi và chúng tôi sẽ cố gắn phản hồi sớm nhất.</h2>
                    <p>Cảm ơn quý khách hàng đã quan tâm đến sản phẩm của Lộc Thiên Thảo!</p>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
