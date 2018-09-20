<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Research Project CISS - PHP</title>

	<link rel="stylesheet" href="css/milligram.min.css">
	<script src="js/sigma.min.js"></script>
	<style>
.card {
    /* Add shadows to create the "card" effect */
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
	padding:10px;
	border-radius:3px;
	min-width:100%;
	margin-bottom:30px;
	border-width:1px;
	border-style:solid;
	border-color:rgb(240, 240, 240);
}
#graph-container {
    max-width: 400px;
    height: 400px;
    margin: auto;
  }
	</style>

</head>
<body>

<!--
Retrieve data from a database and construct a hash table utilizing SHA-256 as the hashing algorithm
Retrieve data from a database and perform a merge sort on one of the values in the table
Retrieve data from a database, model this data as a graph, and utilize Dijkstra’s algorithm to find the shortest distance between two nodes
Generate 20 random numbers and insert them into an array.  Find the maximum and minimum values in this array.

Generate a list of all primes under 500 using the Sieve of Eratosthenes.
Given 10 pairs of strings and one hash value, return a boolean value based on the presence of a hash value from the concatenation of those pairs from the list.
Given the values, insert a row into a database table


	-->

<div class="container">
<h1>Research Project CISS - PHP</h1>
<hr>
<div class="row">
	<div class="card">
	<h3>graph</h3>
	Shortest path from "Carlos <span style="color: #4286f4; font-weight:bold;">(6)</span>" to "Matthew <span style="color: #ff2da0; font-weight:bold;">(77)</span>":
	<h4><?php foreach($graph['path'] as $key => $p){
		echo $p;
		if($key!=count($graph['path'])-1){
			echo ' => ';
		}

	}?></h4>
	<div id="graph-container">
	</div>
	</div>
	</div>
<div class="row">
	<div class="card">
		<h3>hash of random values</h3>
				<table>
					<thead>
						<tr>
						<th>hash</th>
						<th>value</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach($fiftyvalues as $f){
								echo '<tr><td>'.$f['hash'].'</td><td>'.$f['value'].'</td></tr>';
							}
						?>
					</tbody>
				</table>
			</div>
</div>


<div class="row">
	<div class="card">
	<h3>sorted names</h3>


		<table>
			<thead>
				<tr>
				<th>#</th>
				<th>id</th>
				<th>name</th>
				</tr>
			</thead>
			<tbody>
			<?php
				//var_dump($sorted_names);
				$i = 1;
				foreach($sorted_names as $n){
					echo '<tr><td>'.$i.'</td><td>'.$n['id'].'</td><td>'.$n['name'].'</td></tr>';
					$i++;
				}
			?>
			</tbody>
		</table>
	</div>
</div>


<div class="row">
	<div class="card">
	<h3>20 random value</h3>
	<h4>max: <?php echo $minmax['min'];?></h4>
	<h4>min: <?php echo $minmax['max'];?></h4>


		<table>
			<thead>
				<tr>
				<th>value</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($minmax['values'] as $v){
					echo '<tr><td>'.$v.'</td></tr>';
				}
				?>
			</tbody>
		</table>
	</div>
</div>

<div class="row">
	<div class="card">
	<h3>primes under 500</h3>

		<table>
			<tbody>

				<?php
					$i = 0;
					echo '<tr>';
					foreach($primes as $p){
						echo '<td>'.$p.'</td>';
						$i++;
						if($i==10){
							echo '</tr><tr>';
							$i = 0;
						}
					}
					echo '</tr>';
				?>
			</tbody>
		</table>
	</div>
</div>

<div class="row">
	<div class="card">
		<h3>string pairs and check for hash</h3>
		<h5>hash: acb80281e4e94213c7452a81fa08f61893eff5ffa62d50876da8d1fed4710d95</h5>
		<h5>result: <?php echo $checkForHash ? 'true':'false';?></h5>
				<table>
					<thead>
						<tr>
						<th>string1</th>
						<th>string2</th>
						</tr>
					</thead>
					<tbody>
						<tr>
						<td>ethereal</td>
						<td>front</td>
						</tr>
						<tr>
						<td>ask</td>
						<td>release</td>
						</tr>
						<tr>
						<td>bucket</td>
						<td>unique</td>
						</tr>
						<tr>
						<td>plug</td>
						<td>average</td>
						</tr>
						<tr>
						<td>trade</td>
						<td>weather</td>
						</tr>
						<tr>
						<td>card</td>
						<td>wide</td>
						</tr>
						<tr>
						<td>numberless</td>
						<td>copper</td>
						</tr>
						<tr>
						<td>fruit</td>
						<td>example</td>
						</tr>
						<tr>
						<td>slap</td>
						<td>pause</td>
						</tr>
						<tr>
						<td>jittery</td>
						<td>confused</td>
						</tr>
					</tbody>
				</table>
			</div>
</div>

<div class="row">
	<div class="card">
	<h3>database insert</h3>
	The following value was inserted into the <span style="font-weight:bold;">"transactions"</span> table:<br>
	<span style="font-weight:bold;">customer: </span> Bob Jones<br>
	<span style="font-weight:bold;">item: </span> putter<br>
	<span style="font-weight:bold;">price: </span> $5.00<br>
	</div>
</div>


</div>

<script>


	<?php echo 'var data = '.json_encode($graph).';'; ?>
	// Instantiate sigma:
	s = new sigma({
	  graph: data,
	  container: 'graph-container'
	});

	var n1 = s.graph.nodes('6');
	n1.color = '#4286f4';

	var n2 = s.graph.nodes('77');
	n2.color = '#ff2da0';

	s.refresh({ skipIndexation: true });

</script>


</body>
</html>
