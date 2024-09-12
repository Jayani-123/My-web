<?php
class ViewBackToHome
{
    public function output()
    { include "header.php";
        ?>
        <div container-fluid>
            
            <div class="container py-5 h-100">
  <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
      <div class="card shadow-2-strong bg-light" style="border-radius: 1rem;">
        <div class="card-body p-5 text-center">
            <h3 class="mb-5">No Logs Found</h3>
            <p><a href="index.php?action=pageloglist">Back to Home</a></p>
        </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

        </div>
        <?php
    }
}
?>