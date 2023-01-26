<?php $this->load->view('layout/header.php'); ?>
<div class="row">
	<div class="col-md-12">
		<h1 class="text-center">Rating</h1>
		<p class="text-center">Rating Calculator</p>
		<table class="table table-hover" cellpadding=0 cellspacing=10>
			<tr>
				<td>Deductible</td>
				<td>
					<input type="text" name="deductible" id="deductible" class="form-control changeAble" />
				</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Dwelling ($ x per sq)</td>
				<td>
					<input type="text" name="dwelling" id="dwelling" class="form-control changeAble" />
				</td>
				<td><span>$ </span><span id="d_1"></span></td>
				<td><span>$ </span><span id="d_2"></span></td>
				<td><span>$ </span><span id="d_3"></span></td>
				<td><span>$ </span><span id="d_4"></span></td>
				<td><span>$ </span><span id="d_5"></span></td>
				<td><span>$ </span><span id="d_6"></span></td>
				<td><span>$ </span><span id="d_7"></span></td>
				<td><span>$ </span><span id="d_8"></span></td>
				<td><span>$ </span><span id="d_9"></span></td>
				<td><span>$ </span><span id="d_10"></span></td>
				<td><span>$ </span><span id="d_11"></span></td>
			</tr>
			<tr>
				<td>Separate Structure</td>
				<td>
					<div class="input-group">
						<input type="text" name="separateStructure" id="separateStructure" class="form-control changeAble"  aria-describedby="validationTooltipUsernamePrepend">
						<div class="input-group-prepend">
							<span class="input-group-text" id="validationTooltipUsernamePrepend">%</span>
						</div>
					</div>
				</td>
				<td><span>$ </span><span id="ss_1"></span></td>
				<td><span>$ </span><span id="ss_2"></span></td>
				<td><span>$ </span><span id="ss_3"></span></td>
				<td><span>$ </span><span id="ss_4"></span></td>
				<td><span>$ </span><span id="ss_5"></span></td>
				<td><span>$ </span><span id="ss_6"></span></td>
				<td><span>$ </span><span id="ss_7"></span></td>
				<td><span>$ </span><span id="ss_8"></span></td>
				<td><span>$ </span><span id="ss_9"></span></td>
				<td><span>$ </span><span id="ss_10"></span></td>
				<td><span>$ </span><span id="ss_11"></span></td>
			</tr>
			<tr>
				<td>Personal Property</td>
				<td>
					<div class="input-group">
						<input type="text" name="personalProperty" id="personalProperty" class="form-control changeAble"  aria-describedby="validationTooltipUsernamePrepend">
						<div class="input-group-prepend">
							<span class="input-group-text" id="validationTooltipUsernamePrepend">%</span>
						</div>
					</div>
				</td>
				<td><span>$ </span><span id="pp_1"></span></td>
				<td><span>$ </span><span id="pp_2"></span></td>
				<td><span>$ </span><span id="pp_3"></span></td>
				<td><span>$ </span><span id="pp_4"></span></td>
				<td><span>$ </span><span id="pp_5"></span></td>
				<td><span>$ </span><span id="pp_6"></span></td>
				<td><span>$ </span><span id="pp_7"></span></td>
				<td><span>$ </span><span id="pp_8"></span></td>
				<td><span>$ </span><span id="pp_9"></span></td>
				<td><span>$ </span><span id="pp_10"></span></td>
				<td><span>$ </span><span id="pp_11"></span></td>
			</tr>
			<tr>
				<td>Loss of Use</td>
				<td>Up to 12 months</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Liability</td>
				<td></td>
				<td>$ 300,000</td>
				<td>$ 300,000</td>
				<td>$ 300,000</td>
				<td>$ 300,000</td>
				<td>$ 300,000</td>
				<td>$ 300,000</td>
				<td>$ 300,000</td>
				<td>$ 300,000</td>
				<td>$ 300,000</td>
				<td>$ 300,000</td>
				<td>$ 300,000</td>
			</tr>
			<tr>
				<td>Home's Square Feet</td>
				<td></td>
				<td><input class="form-control changeAble" name="hsf_1" id="hsf_1" type="text" /></td>
				<td><input class="form-control changeAble" name="hsf_2" id="hsf_2" type="text" /></td>
				<td><input class="form-control changeAble" name="hsf_3" id="hsf_3" type="text" /></td>
				<td><input class="form-control changeAble" name="hsf_4" id="hsf_4" type="text" /></td>
				<td><input class="form-control changeAble" name="hsf_5" id="hsf_5" type="text" /></td>
				<td><input class="form-control changeAble" name="hsf_6" id="hsf_6" type="text" /></td>
				<td><input class="form-control changeAble" name="hsf_7" id="hsf_7" type="text" /></td>
				<td><input class="form-control changeAble" name="hsf_8" id="hsf_8" type="text" /></td>
				<td><input class="form-control changeAble" name="hsf_9" id="hsf_9" type="text" /></td>
				<td><input class="form-control changeAble" name="hsf_10" id="hsf_10" type="text" /></td>
				<td><input class="form-control changeAble" name="hsf_11" id="hsf_11" type="text" /></td>
			</tr>
		</table>
	</div>
</div>
<script>
	$(document).ready(function ($) {
		$('.changeAble').on('keyup', function (e) {

			$("#d_1").html($("#hsf_1").val() * $("#dwelling").val());
			$("#d_2").html($("#hsf_2").val() * $("#dwelling").val());
			$("#d_3").html($("#hsf_3").val() * $("#dwelling").val());
			$("#d_4").html($("#hsf_4").val() * $("#dwelling").val());
			$("#d_5").html($("#hsf_5").val() * $("#dwelling").val());
			$("#d_6").html($("#hsf_6").val() * $("#dwelling").val());
			$("#d_7").html($("#hsf_7").val() * $("#dwelling").val());
			$("#d_8").html($("#hsf_8").val() * $("#dwelling").val());
			$("#d_9").html($("#hsf_9").val() * $("#dwelling").val());
			$("#d_10").html($("#hsf_10").val() * $("#dwelling").val());
			$("#d_11").html($("#hsf_11").val() * $("#dwelling").val());

			$("#ss_1").html(($("#d_1").html() * $("#separateStructure").val())/100);
			$("#ss_2").html(($("#d_2").html() * $("#separateStructure").val())/100);
			$("#ss_3").html(($("#d_3").html() * $("#separateStructure").val())/100);
			$("#ss_4").html(($("#d_4").html() * $("#separateStructure").val())/100);
			$("#ss_5").html(($("#d_5").html() * $("#separateStructure").val())/100);
			$("#ss_6").html(($("#d_6").html() * $("#separateStructure").val())/100);
			$("#ss_7").html(($("#d_7").html() * $("#separateStructure").val())/100);
			$("#ss_8").html(($("#d_8").html() * $("#separateStructure").val())/100);
			$("#ss_9").html(($("#d_9").html() * $("#separateStructure").val())/100);
			$("#ss_10").html(($("#d_10").html() * $("#separateStructure").val())/100);
			$("#ss_11").html(($("#d_11").html() * $("#separateStructure").val())/100);

			$("#pp_1").html(($("#d_1").html() * $("#personalProperty").val())/100);
			$("#pp_2").html(($("#d_2").html() * $("#personalProperty").val())/100);
			$("#pp_3").html(($("#d_3").html() * $("#personalProperty").val())/100);
			$("#pp_4").html(($("#d_4").html() * $("#personalProperty").val())/100);
			$("#pp_5").html(($("#d_5").html() * $("#personalProperty").val())/100);
			$("#pp_6").html(($("#d_6").html() * $("#personalProperty").val())/100);
			$("#pp_7").html(($("#d_7").html() * $("#personalProperty").val())/100);
			$("#pp_8").html(($("#d_8").html() * $("#personalProperty").val())/100);
			$("#pp_9").html(($("#d_9").html() * $("#personalProperty").val())/100);
			$("#pp_10").html(($("#d_10").html() * $("#personalProperty").val())/100);
			$("#pp_11").html(($("#d_11").html() * $("#personalProperty").val())/100);
		});
	});
</script>
<?php $this->load->view('layout/footer.php'); ?>
