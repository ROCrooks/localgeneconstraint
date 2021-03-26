<?php
$resultshtml = "";

$resultshtml = $resultshtml . '<div class="item">';
if ((isset($globalresults) == true) AND (isset($rawlocal) == true))
  {
  if ($checknucleotide == 0)
    $resultshtml = $resultshtml . "<p>The region of " . $genesymbol . " " . $startrange . "-" . $endrange . " has been analysed!</p>";
  else
    $resultshtml = $resultshtml . "<p>The variant at position " . $genesymbol . ": c." . $checknucleotide . " has been analysed!</p>";

  $resultshtml = $resultshtml . '<p>Gene Identifiers:<br>';
  $resultshtml = $resultshtml . 'Gene Symbol: ' . $genesymbol . '<br>';
  $resultshtml = $resultshtml . 'ENSG: ' . $displayensg . '<br>';
  $resultshtml = $resultshtml . 'ENST: ' . $displayenst . '<br>';
  $resultshtml = $resultshtml . 'UniProt: ' . $displayuniprot . '</p>';

  $resultshtml = $resultshtml . '<p>These are the sequence IDs used to look up the gene sequence, its exons, and translated protein domains.</p>';

  $resultshtml = $resultshtml . '<p>Table 1: Details about the gene and its constraint parameters. These are used to calculate the local constraint.<br>';
  $resultshtml = $resultshtml . '<table class="scientific">';
  $resultshtml = $resultshtml . '<tr>';
  $resultshtml = $resultshtml . '<th>Parameter</th>';
  $resultshtml = $resultshtml . '<th>Gene Wide Score</th>';
  $resultshtml = $resultshtml . '</tr>';
  $resultshtml = $resultshtml . '<tr>';
  $resultshtml = $resultshtml . '<td>Expected Missense</td>';
  $resultshtml = $resultshtml . '<td>' . round($globalresults['ExpectedMissense'],2) . '</td>';
  $resultshtml = $resultshtml . '</tr>';
  $resultshtml = $resultshtml . '<tr>';
  $resultshtml = $resultshtml . '<td>Adjusted Expected Missense</td>';
  $resultshtml = $resultshtml . '<td>' . round($globalresults['AdjustedExpectedMissense'],2) . '</td>';
  $resultshtml = $resultshtml . '</tr>';
  $resultshtml = $resultshtml . '<tr>';
  $resultshtml = $resultshtml . '<td>Observed Missense</td>';
  $resultshtml = $resultshtml . '<td>' . round($globalresults['ObservedMissense'],2) . '</td>';
  $resultshtml = $resultshtml . '</tr>';
  $resultshtml = $resultshtml . '<tr>';
  $resultshtml = $resultshtml . '<td>Z-Score Missense</td>';
  $resultshtml = $resultshtml . '<td>' . round($globalresults['ZMissense'],2) . '</td>';
  $resultshtml = $resultshtml . '</tr>';
  $resultshtml = $resultshtml . '</table></p>';

  $resultshtml = $resultshtml . '<p>These results are for gene wide scores, but
  are used to calculate local results. A result that a gene is subject to constrained
  selection (Z-Score greater than 3.09) means the PP2 ACMG criteria can be applied.
  Note for diagnostic purposes you should use the <a href="https://gnomad.broadinstitute.org/" target="new">gnomAD</a> database.</p>';

  if ($globalresults['ZMissense'] >= 3.09)
    $resultshtml = $resultshtml . "<p>This gene is subject to constrained selection. The Missense Z-Score is " . round($globalresults['ZMissense'],2) . "</p>";

  $resultshtml = $resultshtml . '<p>Table 2: Details about the gene region and its constraint, raw details.<br>';
  $resultshtml = $resultshtml . '<table class="scientific">';
  $resultshtml = $resultshtml . '<tr>';
  $resultshtml = $resultshtml . '<th>Search Window</th>';
  $resultshtml = $resultshtml . '<th>Expected</th>';
  $resultshtml = $resultshtml . '<th>Observed</th>';
  $resultshtml = $resultshtml . '<th>Z-Score</th>';
  $resultshtml = $resultshtml . '</tr>';
  foreach($rawlocal as $localresult)
    {
    $resultshtml = $resultshtml . '<tr>';
    $resultshtml = $resultshtml . '<td>' . $localresult['Name'] . '</td>';
    $resultshtml = $resultshtml . '<td>' . round($localresult['MissenseExpected'],2) . '</td>';
    $resultshtml = $resultshtml . '<td>' . $localresult['VariantsMissense'] . '</td>';
    $resultshtml = $resultshtml . '<td>' . round($localresult['ConstraintMissense'],2) . '</td>';
    $resultshtml = $resultshtml . '</tr>';
    }
  $resultshtml = $resultshtml . '</table>';

  $resultshtml = $resultshtml . '<p>Table 3: Details about the gene region and its constraint, with data normalised.<br>';
  $resultshtml = $resultshtml . '<table class="scientific">';
  $resultshtml = $resultshtml . '<tr>';
  $resultshtml = $resultshtml . '<th>Search Window</th>';
  $resultshtml = $resultshtml . '<th>Expected</th>';
  $resultshtml = $resultshtml . '<th>Observed</th>';
  $resultshtml = $resultshtml . '<th>Z-Score</th>';
  $resultshtml = $resultshtml . '</tr>';
  foreach($normalisedlocal as $localresult)
    {
    $resultshtml = $resultshtml . '<tr>';
    $resultshtml = $resultshtml . '<td>' . $localresult['Name'] . '</td>';
    $resultshtml = $resultshtml . '<td>' . round($localresult['MissenseExpected'],2) . '</td>';
    $resultshtml = $resultshtml . '<td>' . round($localresult['VariantsMissense'],2) . '</td>';
    $resultshtml = $resultshtml . '<td>' . round($localresult['ConstraintMissense'],2) . '</td>';
    $resultshtml = $resultshtml . '</tr>';
    }
  $resultshtml = $resultshtml . '</table>';

  $resultshtml = $resultshtml . '<p>A region subject to constrained selection
  (Z-score greater than 3.09) may indicate a region less tolerant to benign
  variation. Results are given using raw data straight from the database and
  normalized to simulate a region that is the size of the entire gene. Use
  this at your discretion and note it has <b>not been clinically validated.</b></p>';
  }
else
  {
  $resultshtml = $resultshtml . "<p>D'oh! Something appears to have gone wrong!</p>";
  }

$resultshtml = $resultshtml . '</div>';
?>
