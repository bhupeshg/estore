<table width="100%" cellpadding="2" cellspacing="2" border="0">
	<tr>		
		<td align="right">
			<?php
				echo $this->Paginator->first('First', array('class'=>"homeLink"));echo '&nbsp;&nbsp;';
				echo $this->Paginator->prev('Previous',array('class'=>"homeLink"));  echo '&nbsp;&nbsp;';
				echo $this->Paginator->numbers(array('separator'=>' | ')); echo '&nbsp;&nbsp;';
				echo $this->Paginator->next('Next',array('class'=>"homeLink")); echo '&nbsp;';
				echo $this->Paginator->last('Last',array('class'=>"homeLink"));
			?>
		</td>
	</tr>
</table>