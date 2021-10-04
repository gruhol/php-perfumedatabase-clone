	<div class="container">
			<div class="row">
				<div class="span9">
					<div class="register">
					<div class="titleHeader clearfix">
						<h3>Menu administracyjne</h3>
					</div><!--end titleHeader-->

					<p><?php echo anchor('admin/add_news', 'Dodaj Newsa', 'class="btn btn-success"');?></p>
					<p>&nbsp;</p>
					<?php if (isset($message)) { ?>
						<dir class="errors"><?php echo $message;?></dir>
					<?php } ?>
					<table  class="table table-striped">
						<thead>
							<td>ID</td>
							<td>User</td>
							<td>Tytuł</td>
							<td>Data dodania</td>
							<td>Edycja</td>
							<td>Usuń</td>
						</thead>
					<?php foreach ($newses as $row) { ?>
						<tr>
							<td><?php echo $row->id_news; ?></td>
							<td><?php echo $this->portal_model->getNameUser($row->id_user);?></td>
							<td><?php echo $row->title_news; ?></td>
							<td><?php echo $row->adddate_news; ?></td>
							<td><?php
							$param2 = array ('class' => "btn");
							echo anchor("admin/edit_news/$row->id_news", 'Edytuj', $param2); ?></td>
							<td>
								<?php $param = array ('onclick' => "return confirm('Czy napewno chcesz usunąć newsa')", 'class' => "btn btn-danger");
								echo anchor("admin/del_news/$row->id_news", 'Usuń', $param);?>
							</td>
						</tr>	
					<?php } ?>
					</table>
					
					<div class="pagination pagination-centered">
						<ul>
							<?php echo $pagination;?>
						</ul>
					</div>

					</div><!--end register-->
				</div><!--end span9-->

				<div class="span3">
					<div class="titleHeader clearfix">
						<h3>Menu użytkownika</h3>
					</div><!--end titleHeader-->
					<ul class="unstyled my-account">
						<li><a class="invarseColor" href="admin/show_newses"><i class="icon-caret-right"></i> Newsy</a></li>
						<li><a class="invarseColor" href="user/edit_password"><i class="icon-caret-right"></i> Zmień hasło</a></li>
						<li><a class="invarseColor" href="user/logout"><i class="icon-caret-right"></i> Wyloguj</a></li>
					</ul>
					
				</div><!--end span3-->

			</div><!--end row-->

		</div><!--end conatiner-->	