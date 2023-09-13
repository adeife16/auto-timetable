<?php 
	$title = "Exam";
	require_once 'header.php';
?>
<style type="text/css">
  .tabs{
    max-height: 300px !important;
    overflow-y: auto !important;
/*    text-align: center !important;*/
  }
</style>
<style type="text/css">
      .myTabs .tabsContent .tabContent{
        background-color:#ffffff;
        padding:25px;

        font-size:12px;
        display: none;
    }
    .myTabs .tabsContent .tabContent h2{

    }

    .myTabs .tabsContent .tabContent.active{
        display: block;
    }
    .overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 9999;
  display: flex;
  align-items: center;
  justify-content: center;
}

.overlay-message {
  background-color: white;
  padding: 20px;
  border-radius: 5px;
}

</style>
  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      tex2jax: {inlineMath: [['$$','$$'], ['\\(','\\)']]}
    });
  </script>

  <!-- <script src="js/mathlive.min.js" charset="utf-8"></script> -->
  <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", () => {
      setTimeout(function() {
    var script = document.createElement('script');
    script.src = 'node_modules/mathjax/es5/tex-chtml.js'; // Replace 'your-script.js' with the actual path to your JavaScript file
    document.head.appendChild(script);
  }, 2000);
});
</script>
<div class="row justify-content-center">
  <div class="col-md-2">
  	<div class="float-left pl-2">
  		<h1 id="timer" class="text-danger">00:00</h1>
  	</div>
  </div>
  <div class="col-md-8">
  </div>
  <div class="col-md-2">
    <div class="timer-div sticky-top ml-3 p-2 bg-white">
    	<div class="float-right">
    		<button id="" data-toggle="modal" data-target="#submitModal" class="btn btn-danger">Submit Exam</button>
    	</div>
    </div>
  </div>
</div>

<div class="myTabs">
    <div class="tabsTitle row justify-content-center">
        <a class="tabButton btn btn-secondary ml-3" id="math">Mathematics</a>
        <a class="tabButton btn btn-secondary ml-3" id="eng">English</a>
        <a class="tabButton btn btn-secondary ml-3" id="sci">General Science</a>
        <a class="tabButton btn btn-secondary ml-3" id="curr">Current Affairs</a>
    </div>
    <div class="tabsContent">
        <div class="tabContent">
          <h5>MATHEMATICS</h5>
            <div class="row justify-content-center m-3 w-100 p-2">
              <div class="col-md-9 col-sm-12">
                <div class="tabs" id="display-math">

                </div>
              </div>
            </div>
            <div class="row justify-content-center mt-3 p-2">
              <div class="col-md-9 col-sm-12">
                <div class="tabs-menu" id="number-math">

                </div>
              </div>
          </div>
        </div>

        <div class="tabContent">
            <h5>ENGLISH LANGUAGE</h5>
            <div class="row justify-content-center m-3 w-100 p-2">
              <div class="col-md-9 col-sm-12">
                <div class="tabs" id="display-eng">

                </div>
              </div>
            </div>
            <div class="row justify-content-center mt-3 p-2">
              <div class="col-md-9 col-sm-12">
                <div class="tabs-menu" id="number-eng">

                </div>
              </div>
          </div>
        </div>
        <div class="tabContent">
            <h5>General Science</h5>
            <div class="row justify-content-center m-3 w-100 p-2">
              <div class="col-md-9 col-sm-12">
                <div class="tabs" id="display-sci">

                </div>
              </div>
            </div>
            <div class="row justify-content-center mt-3 p-2">
              <div class="col-md-9 col-sm-12">
                <div class="tabs-menu" id="number-sci">

                </div>
              </div>
          </div>
        </div>
        <div class="tabContent">
          <div class="row justify-content-center m-3 w-100 p-2">
            <div class="col-md-9 col-sm-12">
              <div class="tabs" id="display-curr">

              </div>
            </div>
          </div>
          <div class="row justify-content-center mt-3 p-2">
            <div class="col-md-9 col-sm-12">
              <div class="tabs-menu" id="number-curr">

              </div>
            </div>
        </div>
        </div>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="submitModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Submit Exam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-danger">Are you sure you want to submit?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="submitExam" class="btn btn-danger">Submit</button>
      </div>
    </div>
  </div>
</div>


<?php 
	require_once 'footer.php';
?>