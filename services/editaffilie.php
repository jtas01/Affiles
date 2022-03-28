<?php
 session_start();
/*
 * Example PHP implementation used for the index.html example
 */
 
// DataTables PHP library
//C:\xampp\htdocs\ligueCRM\Editor-PHP-2.0.7\lib
//C:\xampp\htdocs\ligueCRM\services
include( "../Editor-PHP-2.0.7/lib/DataTables.php" );
 
// Alias Editor classes so they are easy to use
use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Options,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate,
    DataTables\Editor\ValidateOptions;
 
// Build our Editor instance and process the data coming from _POST
    // ensure can show chinese text     
$db->sql( "SET NAMES 'utf8mb4'" );

$out=Editor::inst( $db, 'affilie' )->pkey('Clé_Affilié')
    ->fields(
        Field::inst( 'Clé_Affilié' )->set(false), // ID is automatically set by the database on create
        Field::inst( 'Clé' ),
        Field::inst( 'status' ),
        Field::inst( 'social_status' ),
        Field::inst( 'Nom_Affilié' )
        ->validator( Validate::notEmpty( ValidateOptions::inst()
            ->message( 'A Nom Affilié is required' ) 
        ) ),
        Field::inst( 'Prénom_Affilié' )
            ->validator( Validate::notEmpty( ValidateOptions::inst()
                ->message( 'A Prénom Affilié is required' )  
            ) ),
        Field::inst( 'Date_de_décès' )
           ->validator( Validate::dateFormat( 'Y-m-d' ) )
            ->getFormatter( Format::dateSqlToFormat( 'Y-m-d' ) )
            ->setFormatter( Format::dateFormatToSql('Y-m-d' ) ),
       
        Field::inst( 'Date_du_diagnostic' )
           ->validator( Validate::dateFormat( 'Y-m-d' ) )
            ->getFormatter( Format::dateSqlToFormat( 'Y-m-d' ) )
            ->setFormatter( Format::dateFormatToSql('Y-m-d' ) ),
         Field::inst( 'Courriel' )
            ->validator( Validate::email( ValidateOptions::inst()
                ->message( 'Please enter an Courriel email address' )   
            ) ),
        Field::inst( 'Naissance_Affilié' )
           ->validator( Validate::dateFormat( 'Y-m-d' ) )
            ->getFormatter( Format::dateSqlToFormat( 'Y-m-d' ) )
            ->setFormatter( Format::dateFormatToSql('Y-m-d' ) ),
        Field::inst( 'Téléphone_Affilié' ),
        Field::inst( 'Institution_Affilié' ),
        Field::inst( 'Adresse_Affilié' ),
        Field::inst( ' Conjoint_Affilié' ),
         Field::inst( 'Institution_Affilié_envoi' ),
          Field::inst( 'GSM_ou_autre_tel' ),
         Field::inst( 'Adresse_envoi' ),
          Field::inst( 'Code_handicap' ),
          Field::inst( 'Mémo' ),
          Field::inst( 'Nbre_enfants_à_charge' ),
          Field::inst( 'Sylvie' ),
          Field::inst( 'Clé_Province' ),
        Field::inst( 'Clé_Code_Postal' ),
         Field::inst( 'CP_envoi' ), 
         Field::inst( 'Clé_Assistante_Sociale' ),     
         Field::inst( 'Clé_situation_familiale' ),
          Field::inst( 'Clé_Etat_Civil' ),     
        Field::inst( 'Inactif-Obselete' )
            ->setFormatter( function ( $val, $data, $opts ) {
                return ! $val ? "FALSE" : "TRUE";
            } ),
        Field::inst( 'BIM' )
            ->setFormatter( function ( $val, $data, $opts ) {
                return ! $val ? "FALSE" : "TRUE";
        } ) ,
         Field::inst( 'Pas_Invitation' )
            ->setFormatter( function ( $val, $data, $opts ) {
               return ! $val ? "FALSE" : "TRUE";
        } ) , 
        Field::inst( 'Plus_de_contact' )
            ->setFormatter( function ( $val, $data, $opts ) {
                return ! $val ? "FALSE" : "TRUE";
        } ) ,
        Field::inst( 'Pas_de_courriers' )
            ->setFormatter( function ( $val, $data, $opts ) {
               return ! $val ? "FALSE" : "TRUE";
        } ) , 
             Field::inst( 'Gratuit_Aff' )
            ->setFormatter( function ( $val, $data, $opts ) {
                return ! $val ? "FALSE" : "TRUE";
        } ) ,
        Field::inst( 'RGPD' )
            ->setFormatter( function ( $val, $data, $opts ) {
               return ! $val ? "FALSE" : "TRUE";
        } ) ,
        Field::inst( 'VOLONTAIRE' )
            ->setFormatter( function ( $val, $data, $opts ) {
                return ! $val ? "FALSE" : "TRUE";
        } ) ,  

        Field::inst( 'LaClef' ),
      
        
        Field::inst( 'Nouveau' )
            ->setFormatter( function ( $val, $data, $opts ) {
                return ! $val ? "FALSE" : "TRUE";
        }), 
         Field::inst( 'Prob_adresse' )
            ->setFormatter( function ( $val, $data, $opts ) {
                 return ! $val ? "FALSE" : "TRUE";
        } ) ,
         Field::inst( 'IM' )
            ->setFormatter( function ( $val, $data, $opts ) {
                 return ! $val ? "FALSE" : "TRUE";
        } ) 

    )


    ->debug(true)

    ->process( $_POST )
    ->json();
    /*
// On 'read' remove the DT_RowId property so we can see fully how the `idSrc`
// option works on the client-side.
if ( Editor::action( $_POST ) === Editor::ACTION_READ ) {
    for ( $i=0, $ien=count($out['data']) ; $i<$ien ; $i++ ) {
        unset( $out['data'][$i]['DT_RowId'] );
    }
}
 
// Send it back to the client
echo json_encode( $out );*/