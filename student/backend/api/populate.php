<?php 
	require_once '../database.php';

	$db= new Database();

// $class = ["AE-1", "AE-2", "AE-3", "AE-4", "AE-5", "AE-6", "AF-1", "AF-2", "AF-3", "AF-4", "AF-5", "AF-6", "AG-1", "AG-2", "AG-3", "AG-4", "AG-5", "BA-1", "BA-2", "BA-3", "BA-4", "BA-5", "BA-6", "BB-1", "BB-2", "BB-3", "BB-4", "BB-5", "BB-6", "BC-1", "BC-2", "BC-3", "BC-4", "BC-5", "BC-6", "BD-1", "BD-2", "BD-3", "BD-4", "BD-5", "BD-6", "BE-1", "BE-2", "BE-3", "BE-4", "BE-5", "BE-6", "BF-1", "BF-2", "BF-3", "BF-4", "BF-5", "BF-6"];

$names = [
    "Abdulhamid, I. G.",
    "Abdulraheem, A. Y.",
    "Abioye, G. A.",
    "Aboloje, A. C.",
    "Adamu, A. D.",
    "Adaramola, O. J. Engr.",
    "Adeala, A. J. Engr.",
    "Adebanji, S. A.",
    "Adebesin, A. A. Engr.",
    "Adedokun, A. M. Surv.",
    "Adegbenro, S. A. Engr. (Dr.)",
    "Adegbesan, O. O.",
    "Adekanmbi, A. Y.",
    "Adeleye, A. D.",
    "Adenaiya, O. A.",
    "Adenigba, A. A. Engr.",
    "Adeoye, K. T. Mrs.",
    "Adesanmi, M. A.",
    "Adetona, Z. A. Engr.",
    "Adetunji, O. A.",
    "Adewara, M. B. Surv",
    "Adiyeloja, I. T. Engr.",
    "Afunlehin, O. A.",
    "Agbolade, O. A.",
    "Agbongiaban, F. E.",
    "Aikulola, O. A. Engr.",
    "Aiyelabowo, O. P. Engr. Dr.",
    "Ajayi, A. M. Miss",
    "Ajetunmobi, D. T. Engr.",
    "Ajibade, T. E. Miss",
    "Ajibodu, F. A. Engr.",
    "Ajibola, W. A. Engr.",
    "Ajibose, T. S.",
    "Akanbi, O. O.",
    "Akinbola, S. M. Mrs.",
    "Akingbade, L. O. Mrs.",
    "Akinpelu, O. O.",
    "Akinseinde, O. A.",
    "Akintade, J. O. Engr.",
    "Akintola O. M.",
    "Alausa, W. S. Engr.",
    "Aliu, O. H.",
    "Alu, A. N. Miss",
    "Alugbele, O. A. Mrs.",
    "Ayegbusi, O. A. Mrs.",
    "Ayodele, A. E.",
    "Babarinde, B. F. Engr.",
    "Babayemi, D.I. Mrs.",
    "Badru, J. O.",
    "Bitrus, B. I.",
    "Buoye, A. P.",
    "Chapi, S. P.",
    "Dada, D. A. Engr.",
    "Dawodu, H. O.",
    "Durojaiye, O. P. Dr.",
    "Edun, O. M. Mrs.",
    "Enemaku, L. E. Engr.",
    "Evavoawe, F. O.",
    "Eze, B. E. Engr. (Mrs.)",
    "Ezekiel, I. D.",
    "Fadare, S. A. Engr.",
    "Fagbuaro, O. E.",
    "Fasakin, C. D.",
    "Fasasi, T. A. Engr.",
    "Fatunmbi, E. O. Dr.",
    "Ibikunle, C. D. Miss",
    "Ibrahim, G. W. Engr.",
    "Idowu, T.",
    "Jaiyeoba, O. O. Mrs.",
    "Jiboku, F. J.",
    "Joseph, E. A. Engr.",
    "Joseph, O. O. Engr.",
    "Kosemani, B. S.",
    "Lawal, A. N.",
    "Lawal, R. A. Miss",
    "Lawal, S. A.",
    "Mathew, T. O. Engr.",
    "Mbamaluikem, P. O.",
    "Mosaku, A. O.",
    "Nwaobasi, U. N.",
    "Odede, O. M.",
    "Oderinde, M. O.",
    "Oderinde, S. A.",
    "Odetunde, M. W.",
    "Odunlami, S. A. Dr. Engr.",
    "Oduwole, A. S.",
    "Oginni, I. M. Mrs.",
    "Ogunlade, C. B. Engr.",
    "Ogunseitan, T. O.",
    "Ogunseye, J. O.",
    "Ogunyemi, O. J. Engr.",
    "Ogunyinka, O. I.",
    "Ojo, B. A. Engr.",
    "Ojo, G. O.",
    "Ojochegbe, A. T.",
    "Ojuawo, O. O.",
    "Okeke, H. S.",
    "Okeze, R. C. Mrs.",
    "Okoro, N. O.",
    "Okoye, C. U. Engr.",
    "Okparavero, O. O. Miss",
    "Okusanya, M. A. Engr.",
    "Olabode, O. R.",
    "Olaiya, O. O. Engr.",
    "Olaoye, J. O.",
    "Olarewaju, A. J. Dr.",
    "Olasina, J. R. Engr.",
    "Olatunji, O. M. Mrs.",
    "Olatunji, O. T. Mrs.",
    "Olayiwola, J. O. Mrs.",
    "Oloruko-Oba, A. A.",
    "Olowofela, S. S. Engr.",
    "Oloyede, E. O.",
    "Oluigbo, C. V.",
    "Olusona, E. O.",
    "Omolola, A. S. Engr.",
    "Omopariola, S. S. Engr.",
    "Omotola, O. E.",
    "Onigbara, V. B.",
    "Onipede, F. M.",
    "Onwuasoanya, N. C.",
    "Oretan, I. L.",
    "Oyebolu, I. D. Mrs.",
    "Phillips, O. O.",
    "Raji, O. K. Engr. (Mrs.)",
    "Sadiku, M. K. Bldr",
    "Salako, F. O.",
    "Sanni, E. O.",
    "Sekoni, R. T.",
    "Shobanke, E. K.",
    "Sikiru, O. A.",
    "Sodeinde, V. O.",
    "Sonde, E. O.",
    "Sotayo, F. O.",
    "Soyemi, O. B. Engr. (Dr.)",
    "Soyemi, S. J. Dr. (Mrs.)",
    "Suleiman, A. D.",
    "Sunday, B. D.",
    "Udoh, U. J.",
    "Uduak, E.",
    "Yinusa, A. A.",
    "Yusuf, S. O. Mrs.",
    "Yusuf, M. A. Mrs."
];

$err = false;
for ($i=1; $i <= count($names); $i++)
{ 
	$insert = $db->insert("Lecturers", ["lecturer_name" => $names[$i]]);
	if(!$insert){$err = true;}
}

if(!$err)
{
	echo "Success";
}

?>