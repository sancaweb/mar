<?php $this->output(TMP.'header');?>
    <body>
        <?php $this->output(TMP.'navtop');?>

        <div id="body-container">
            <div id="body-content">
                
                <?php $this->output(TMP.'header1');?>    
                <?php $this->output(TMP.'header2');?>
                
        
    <section class="page container">
	<?php $this->output($konten);?>
    </section>
            </div>
        </div>
		<?php $this->output(TMP.'footer');?>

        