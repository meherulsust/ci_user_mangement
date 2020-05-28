<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=\"excel_output_cv.xls\"");

/*
* Excel library for Code Igniter applications
* Md. Sarwar Jahan //Modified 02/05/2011//stalinruet@yahoo.com
*/
function to_excel($result_rows,$filename='excel_output_cv')
{
$ths = array('Applicant Number','Applicant Start date','Applicant End date','Referance Check','Referance Employee Number','Applicant Personal Area',
'Applicant Group','Applicant Range','Personnal start date','Personnal end date','Personnal Title','Applicant Last Name','Applicant First Name',
'Gendar','Date Of Birth','Nationality','Marital Status','Blood Group','Personnal Member','Org start date','Org End date','Personnel Sub Area',
'Personnel Officer','Start Date','Address end date','Address Care of','Address street','Address','Postal Code','City', 'District','Country',
'Telephone','Advetisement Start date','Advetisement off id','Advetisement spapl','Advetisement Media','Advetisement applicant','Vacancy start date',
'Vacancy End date','Vacancy priority','Vacancy','Vacancy assigiment','Vacancy Status','SSC Start Date','SSC End Date','Country','Certificate','Duration',
'Secondary units','Secondary Institute','Final Grade','Major Specialisation','HSC Start date','HSC End Date','HSC Country','HSC Certificate',
'HSC duration','HSC units','University/Institute','HSC Grade/Percentage/Division','HSC Specialization','Graduation Start date','Graduation End Date',
'Graduation Country','Graduation Certificate','Graduation duration','Graduation units','Graduation Institute','Graduation Grade',
'Graduation Specialization','PostGraduation Start date','PostGraduation End Date','PostGraduation Country','PostGraduation Certificate',
'PostGraduation duration','PostGraduation  units','University','PostGraduation Grade','PostGraduation Specialization','Previous Company Start Date',
'Previous Employment End date','Previous Employment Employer','Previous Employment City','Previous Employment Country','Previous Employment Work',	
'Previous Company Industry','Previous Employment Desigination',	'Training Start Date','Training End Date','Training','Training Topic','Training Insituate',
'Training  Country','Training Location','Training  Year','Training Duration','Training Units','Communication Start Date','Communication End date',
'Applicant Mail ID/Email ID');//nirjhar___11-oct-2012

 //   $ths = array('User ID','firstname-Adreess','Experience','Education','Age','E Salary','Mobile',''); 
	//$data = '';

     if(sizeof($result_rows) == -1) 
		{
		echo '<p>The table appears to have no data.</p>';
		}
	 else 
		{
		  foreach ($ths as $field) 
			{
			  $headers .= $field. "\t";
			}

		foreach($result_rows as $row) 
			{
			    $line = '';
			    //echo $row['id'];
			   
 				foreach($row as $value) 
					{
						if ((!isset($value)) OR ($value == "")) {
							 $value = "\t";
						} else {
							 $value = str_replace('"', '""', $value);
							 $value = '"' . $value . ' "' . "\t";
						}
						$value = utf8_decode($value);  
						$line .= $value;
					} 
			    $data .= trim($line)."\n";
			}

		  $data = str_replace("\r","",$data);
		  
		  echo "$headers\n$data";  
		}
}
?> 