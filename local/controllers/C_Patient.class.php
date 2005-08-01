<?php
require_once CELLINI_ROOT."/ordo/ORDataObject.class.php";
require_once CELLINI_ROOT."/includes/Grid.class.php";
require_once APP_ROOT ."/local/controllers/C_Coding.class.php";

/**
 * Controller Clearhealth Patient actions
 */
class C_Patient extends Controller {

	var $number_id = 0;
	var $address_id = 0;
	var $identifier_id = 0;
	var $insured_relationship_id = 0;
	var $person_person_id = 0;
	var $encounter_date_id = 0;
	var $encounter_value_id = 0;
	var $encounter_person_id = 0;
	var $payment_id = 0;
	var $patient_statistics_id = 0;
	var $coding;
	var $coding_parent_id = 0;
	var $note_id = 0;

	function C_Patient() {
		parent::Controller();
		$this->_load_controller_vars();	

		$this->coding = new C_Coding();
	}
	
	/**
	 * Summary view showing patients forms, reports, encounters, summary
	 * demographics, prescriptions documents
	 *
	 */
	function dashboard_action_view($patient_id = "") {
		if (is_numeric($patient_id) && $patient_id > 0) {
			if ($this->get('patient_id') != $patient_id) {
				$this->set("encounter_id",false);	
			}
			$this->set("patient_id",$patient_id);	
		} 
		
		if (is_numeric($this->get("patient_id")) && $this->get("patient_id") > 0){
			$this->set('external_id',$this->get('patient_id'));
			$p = ORDataObject::Factory("patient",$this->get("patient_id"));
			$number =& ORDataObject::factory('PersonNumber',$this->number_id,$patient_id);
			$address =& ORDataObject::factory('PersonAddress',$this->address_id,$patient_id);
			$insuredRelationship =& ORDataObject::factory('InsuredRelationship',$this->insured_relationship_id,$patient_id);
			$insuredRelationshipGrid =& new cGrid($p->insuredRelationshipList());
			$insuredRelationshipGrid->name = "insuredRelationshipGrid";
			$insuredRelationshipGrid->indexCol = false;

			$encounter =& ORDataObject::factory("Encounter");
			$encounterGrid =& new cGrid($encounter->encounterList($this->get('patient_id')));
			$encounterGrid->name = "encounterGrid";
			$encounterGrid->registerTemplate('date_of_treatment','<a href="'.Cellini::link('encounter').'id={$encounter_id}">{$date_of_treatment}</a>');
			$encounterGrid->pageSize = 5;

			$formData =& ORDataObject::factory("FormData");
			$formDataGrid =& new cGrid($formData->dataListForPatientByExternalId($this->get('patient_id')));
			$formDataGrid->name = "formDataGrid";
			$formDataGrid->registerTemplate('name','<a href="'.Cellini::link('data','Form').'id={$form_data_id}">{$name}</a>');
			$formDataGrid->pageSize = 10;
			
			$menu = Menu::getInstance();
			$tmp = $menu->getMenuData('patient',90);

			$formList = array();
			if (isset($tmp['forms'])) {
				foreach($tmp['forms'] as $form) {
					$formList[$form['form_id']] = $form['title'];
				}	
			}

			$report =& ORDataObject::factory("Report");
			$reportGrid = new cGrid($report->connectedReportList(89));
			$reportGrid->name = "reportGrid";
			$reportGrid->registerTemplate("title",'<a href="'.Cellini::link('report').'report_id={$report_id}&template_id={$report_template_id}">{$title}</a>');

			$note =& ORDataObject::factory('PatientNote');
			$noteGrid =& new cGrid($note->listNotes($this->get('patient_id'),0));
			$noteGrid->pageSize = 10;
			$noteGrid->indexCol = false;
			
			$clearhealth_claim = ORDataObject::factory("ClearhealthClaim");
			$accountStatus = $clearhealth_claim->accountStatus($this->get("patient_id"));

			require_once APP_ROOT .'/local/includes/AppointmentDatasource.class.php';
			$appointmentDS =& new AppointmentDatasource($this->get('patient_id'));
			$appointmentGrid =& new cGrid($appointmentDS);
			$appointmentGrid->pageSize = 10;
			
			$this->assign_by_ref("person",$p);
			$this->assign_by_ref('number',$number);
			$this->assign_by_ref('address',$address);
			$this->assign_by_ref('insuredRelationship',$insuredRelationship);
			$this->assign_by_ref('insuredRelationshipGrid',$insuredRelationshipGrid);
			$this->assign_by_ref('encounterGrid',$encounterGrid);
			$this->assign_by_ref('formDataGrid',$formDataGrid);
			$this->assign_by_ref('reportGrid',$reportGrid);
			$this->assign_by_ref('accountStatus',$accountStatus);
			$this->assign_by_ref('noteGrid',$noteGrid);
			$this->assign_by_ref('depnoteGrid',$depnoteGrid);
			$this->assign_by_ref('note',$note);
			$this->assign_by_ref('appointmentGrid',$appointmentGrid);

			$this->assign('formList',$formList);

			$this->assign('ENCOUNTER_ACTION',Cellini::link('encounter'));
			$this->assign('ACCOUNT_ACTION',Cellini::link('history','account',true,$this->get("patient_id")));
			$this->assign('FORM_FILLOUT_ACTION',Cellini::link('fillout','Form'));
			$this->assign('EDIT_ACTION',Cellini::link('edit',true,true,$this->get('patient_id')));
			$this->assign('NO_PATIENT', false);			
			$this->assign('NOTE_ACTION',Cellini::managerLink('note',$this->get('patient_id')));
			$this->assign('DELETE_NUMBER_ACTION',Cellini::managerLink('deleteNumber',$patient_id));
			$this->assign('DELETE_ADDRESS_ACTION',Cellini::managerLink('deleteAddress',$patient_id));
		}
		else {
			$this->assign('NO_PATIENT', true);
			$this->messages->addMessage('There is no currently selected patient or an invalid patient number was supplied.');	
		}
		
		return $this->fetch(Cellini::getTemplatePath("/patient/" . $this->template_mod . "_dashboard.html"));
	}

	/**
	 * Edit/Add an Patient
	 *
	 */
	function edit_action_edit($patient_id = 0) {
		if (isset($this->patient_id)) {
			$patient_id = $this->patient_id;
		}

		$this->set('patient_id',$patient_id);

		$user =& ORdataObject::factory('User');
		$person =& ORdataObject::factory('Patient',$patient_id);
		$number =& ORDataObject::factory('PersonNumber',$this->number_id,$patient_id);
		$address =& ORDataObject::factory('PersonAddress',$this->address_id,$patient_id);
		$identifier =& ORDataObject::factory('Identifier',$this->identifier_id,$patient_id);

		$nameHistoryGrid =& new cGrid($person->nameHistoryList());
		$nameHistoryGrid->name = "nameHistoryGrid";
		$identifierGrid =& new cGrid($person->identifierList());
		$identifierGrid->name = "identifierGrid";
		$identifierGrid->registerTemplate('identifier','<a href="'.Cellini::ManagerLink('editIdentifier',$patient_id).'id={$identifier_id}&process=true">{$identifier}</a>');
		$identifierGrid->registerTemplate('actions','<a href="'.Cellini::ManagerLink('deleteIdentifier',$patient_id).'id={$identifier_id}&process=true">delete</a>');
		$identifierGrid->setLabel('actions',false);

		$insuredRelationship =& ORDataObject::factory('InsuredRelationship',$this->insured_relationship_id,$patient_id);
		$insuredRelationshipGrid =& new cGrid($person->insuredRelationshipList());
		$insuredRelationshipGrid->name = "insuredRelationshipGrid";
		$insuredRelationshipGrid->registerTemplate('company','<a href="'.Cellini::ManagerLink('editInsuredRelationship',$patient_id).'id={$insured_relationship_id}&process=true">{$company}</a>');
		$insuredRelationshipGrid->indexCol = false;
		$this->payerCount = $insuredRelationship->numRelationships($patient_id);
		$insuredRelationshipGrid->registerFilter('program_order',array(&$this,'_movePayer'));

		$subscriber =& ORDataObject::factory('Patient',$insuredRelationship->get('subscriber_id'));

		$insuranceProgram =& ORDataObject::Factory('InsuranceProgram');
		$this->assign_by_ref('insuranceProgram',$insuranceProgram);

		$personPerson =& ORDataObject::factory('PersonPerson',$this->person_person_id);
		$personPersonGrid = new cGrid($personPerson->relatedList($patient_id));
		$personPersonGrid->name = "personPersonGrid";
		//$personPersonGrid->registerTemplate('relation_type','<a href="'.Cellini::ManagerLink('editPersonPerson',$patient_id).'id={$person_person_id}&process=true">{$relation_type}</a>');

		$building =& ORDataOBject::factory('Building');
		$encounter =& ORDataOBject::factory('Encounter');
		
		$patientStatistics =& ORDataObject::factory('PatientStatistics',$patient_id);
		
		$this->assign("providers_array",$this->utility_array($user->users_factory("provider"),"id","username"));
		$this->assign_by_ref('person',$person);
		$this->assign_by_ref('building',$building);
		$this->assign_by_ref('encounter',$encounter);
		$this->assign_by_ref('number',$number);
		$this->assign_by_ref('address',$address);
		$this->assign_by_ref('identifier',$identifier);
		$this->assign_by_ref('nameHistoryGrid',$nameHistoryGrid);
		$this->assign_by_ref('identifierGrid',$identifierGrid);
		$this->assign_by_ref('insuredRelationship',$insuredRelationship);
		$this->assign_by_ref('insuredRelationshipGrid',$insuredRelationshipGrid);
		$this->assign_by_ref('personPerson',$personPerson);
		$this->assign_by_ref('personPersonGrid',$personPersonGrid);
		$this->assign_by_ref('patientStatistics',$patientStatistics);
		$this->assign_by_ref('subscriber',$subscriber);
		$this->assign('FORM_ACTION',Cellini::managerLink('update',$patient_id));
		$this->assign('EDIT_NUMBER_ACTION',Cellini::managerLink('editNumber',$patient_id));
		$this->assign('DELETE_NUMBER_ACTION',Cellini::managerLink('deleteNumber',$patient_id));
		$this->assign('EDIT_ADDRESS_ACTION',Cellini::managerLink('editAddress',$patient_id));
		$this->assign('DELETE_ADDRESS_ACTION',Cellini::managerLink('deleteAddress',$patient_id));
		$this->assign('NEW_PAYER',Cellini::managerLink('editInsuredRelationship',$patient_id)."id=0&&process=true");
		$this->assign('hide_type',true);

		$this->assign('now',date('Y-m-d'));

		return $this->fetch(Cellini::getTemplatePath("/patient/" . $this->template_mod . "_edit.html"));
	}

	/**
	 * List Patients
	 */
	function list_action_view() {
		$person =& ORDataObject::factory('Patient');

		$ds =& $person->patientList();
		$ds->template['name'] = "<a href='".Cellini::link('dashboard')."id={\$person_id}'>{\$name}</a>";
		$grid =& new cGrid($ds);
		$grid->pageSize = 50;

		$this->assign_by_ref('grid',$grid);

		return $this->fetch(Cellini::getTemplatePath("/patient/" . $this->template_mod . "_list.html"));
	}

	/**
	 * Edit/Add an encounter
	 */
	function encounter_action_edit($encounter_id = 0,$appointment_id = 0,$patient_id = 0) {
		settype($encounter_id,'int');
		$valid_appointment_id = false;
		
		if (isset($this->encounter_id)) {
			$encounter_id = $this->encounter_id;
		}


		// check if an encounter_id already exists for this appointment
		if ($appointment_id > 0) {
			ORDataObject::factory_include('Encounter');
			$id = Encounter::encounterIdFromAppointmentId($appointment_id);
			if ($id > 0) {
				$valid_appointment_id = true;
				$encounter_id         = $id;
			} 
		}

		if ($encounter_id > 0) {
			$this->set('encounter_id',$encounter_id);
			$this->set('external_id', $this->get('encounter_id'));
		}
		if ($patient_id > 0) {
			$this->set('patient_id',$patient_id);
		}
		//if ($encounter_id == 0 && $this->get('encounter_id') > 0) {
		//	$encounter_id = $this->get('encounter_id');
		//}	
		$this->set('encounter_id',$encounter_id);
		$encounter =& ORDataObject::factory('Encounter',$encounter_id,$this->get('patient_id'));
		$person =& ORDataObject::factory('Person');
		$building =& ORDataObject::factory('Building');

		$encounterDate =& ORDataObject::factory('EncounterDate',$this->encounter_date_id,$encounter_id);
		$encounterDateGrid = new cGrid($encounterDate->encounterDateList($encounter_id));
		$encounterDateGrid->name = "encounterDateGrid";
		$encounterDateGrid->registerTemplate('date','<a href="'.Cellini::Managerlink('editEncounterDate',$encounter_id).'id={$encounter_date_id}&process=true">{$date}</a>');
		$this->assign('NEW_ENCOUNTER_DATE',Cellini::managerLink('editEncounterDate',$encounter_id)."id=0&process=true");

		$encounterValue =& ORDataObject::factory('EncounterValue',$this->encounter_value_id,$encounter_id);
		$encounterValueGrid = new cGrid($encounterValue->encounterValueList($encounter_id));
		$encounterValueGrid->name = "encounterValueGrid";
		$encounterValueGrid->registerTemplate('value','<a href="'.Cellini::Managerlink('editEncounterValue',$encounter_id).'id={$encounter_value_id}&process=true">{$value}</a>');
		$this->assign('NEW_ENCOUNTER_VALUE',Cellini::managerLink('editEncounterValue',$encounter_id)."id=0&process=true");

		$encounterPerson =& ORDataObject::factory('EncounterPerson',$this->encounter_person_id,$encounter_id);
		$encounterPersonGrid = new cGrid($encounterPerson->encounterPersonList($encounter_id));
		$encounterPersonGrid->name = "encounterPersonGrid";
		$encounterPersonGrid->registerTemplate('person','<a href="'.Cellini::Managerlink('editEncounterPerson',$encounter_id).'id={$encounter_person_id}&process=true">{$person}</a>');
		$this->assign('NEW_ENCOUNTER_PERSON',Cellini::managerLink('editEncounterPerson',$encounter_id)."id=0&process=true");
		
		$payment =& ORDataObject::factory('Payment',$this->payment_id);
		if ($payment->_populated == false) {
			$payment->set('title','Co-Pay');
		}
		$payment->set("encounter_id",$encounter_id);
		$paymentGrid = new cGrid($payment->paymentsFromEncounterId($encounter_id));
		$paymentGrid->name = "paymentGrid";
		$paymentGrid->registerTemplate('amount','<a href="'.Cellini::Managerlink('editPayment',$encounter_id).'id={$payment_id}&process=true">{$amount}</a>');
		$this->assign('NEW_ENCOUNTER_PAYMENT',Cellini::managerLink('editPayment',$encounter_id)."id=0&process=true");

		
		$appointments = $encounter->appointmentList();
		$appointmentArray = array("" => " ");
		foreach($appointments as $appointment) {
			$appointmentArray[$appointment['occurence_id']] = date("m/d/Y H:i",strtotime($appointment['appointment_start'])) . " " . $appointment['building_name'] . "->" . $appointment['room_name'] . " " . $appointment['provider_name'];
		}
		
		
		// If this is a saved encounter, generate the following:
		if ($this->get('encounter_id') > 0) {
			// Load data that has been stored
			$formData =& ORDataObject::factory("FormData");
			$formDataGrid =& new cGrid($formData->dataListByExternalId($encounter_id));
			$formDataGrid->name  = "formDataGrid";
			$formDataGrid->registerTemplate('name','<a href="'.Cellini::link('data','Form').'id={$form_data_id}">{$name}</a>');
			$formDataGrid->pageSize = 10;
			
			// Generate a menu of forms that are connected to Encounters
			$menu = Menu::getInstance();
			$connectedForms = $menu->getMenuData('patient',
				$menu->getMenuIdFromTitle('patient','Encounter Forms'));
			
			$formList = array();
			if (isset($connectedForms['forms'])) {
				foreach($connectedForms['forms'] as $form) {
					$formList[$form['form_id']] = $form['title'];
				}
			}
		}
		
		//if an appointment id is supplied the request is coming from the 
		//calendar and so prepopulate the defaults
		if ($appointment_id > 0 && $valid_appointment_id) {
			$encounter->set("occurence_id",$appointment_id);
			$encounter->set("patient_id",$this->get("patient_id"));
			if (isset($appointments[$appointment_id])) {
				$encounter->set("building_id",$appointments[$appointment_id]['building_id']);
			}
			if (isset($appointments[$appointment_id])) {
				$encounter->set("treating_person_id",$appointments[$appointment_id]['provider_id']);
			}
		}

		$insuredRelationship =& ORDataObject::factory('InsuredRelationship');


		$this->assign_by_ref('insuredRelationship',$insuredRelationship);
		$this->assign_by_ref('encounter',$encounter);
		$this->assign_by_ref('person',$person);
		$this->assign_by_ref('building',$building);
		$this->assign_by_ref('encounterDate',$encounterDate);
		$this->assign_by_ref('encounterDateGrid',$encounterDateGrid);
		$this->assign_by_ref('encounterPerson',$encounterPerson);
		$this->assign_by_ref('encounterPersonGrid',$encounterPersonGrid);
		$this->assign_by_ref('encounterValue',$encounterValue);
		$this->assign_by_ref('encounterValueGrid',$encounterValueGrid);
		$this->assign_by_ref('payment',$payment);
		$this->assign_by_ref('paymentGrid',$paymentGrid);
		$this->assign_by_ref('appointmentList',$appointments);
		$this->assign_by_ref('appointmentArray',$appointmentArray);
		
		$this->assign('FORM_ACTION',Cellini::link('encounter',true,true,$encounter_id));
		$this->assign('FORM_FILLOUT_ACTION',Cellini::link('fillout','Form'));

		if ($encounter_id > 0 /*&& $encounter->get('status') !== "closed"*/) {
			$this->coding->assign('FORM_ACTION',Cellini::link('encounter',true,true,$encounter_id));
			$this->coding->assign("encounter", $encounter);
			$codingHtml = $this->coding->update_action_edit($encounter_id,$this->coding_parent_id);
			$this->assign('codingHtml',$codingHtml);
			$this->assign_by_ref('formDataGrid',$formDataGrid);
			$this->assign_by_ref('formList',$formList);
		}

		if ($encounter->get('status') === "closed") {
			ORDataObject::factory_include('ClearhealthClaim');
			$claim =& ClearhealthClaim::fromEncounterId($encounter_id);
			$this->assign('FREEB_ACTION',$GLOBALS['C_ALL']['freeb2_dir'] . substr(Cellini::link('list_revisions','Claim','freeb2',$claim->get('identifier'),false,false),1));
			$this->assign('PAYMENT_ACTION',Cellini::link('payment','Eob',true,$claim->get('id')));

			$this->assign('encounter_has_claim',false);
			if ($claim->_populated) {
				$this->assign('encounter_has_claim',true);
			}

			/* moved to menu
			// todo: get this without hard coding in the report and template id
			$exit_base_link = str_replace("main","PDF",Cellini::link('report',true,true));
			$this->assign('EXIT_REPORT',$exit_base_link."report_id=17075&template_id=17077&encounter_id=".$encounter->get('id'));
			*/

			// see if we need to add a rebill link
			if ($this->_canRebill($encounter->get('id'))) {
				$this->assign('REOPEN_ACTION',Cellini::link('reopen_encounter', true, true, $encounter->get('id')) . 'process=true');
				//$this->assign('REBILL_ACTION',Cellini::link('rebill_encounter',true,true,$encounter->get('id'))."process=true");
			}

			
		}
		else {
			ORdataObject::factory_include('ClearhealthClaim');
			$claim =& ClearhealthClaim::fromEncounterId($encounter_id);
			if ($claim->get('identifier') > 0) {
				$this->assign('claimSubmitValue', 'rebill');
			}
			else {
				$this->assign('claimSubmitValue', 'close');
			}
			//printf('<pre>%s</pre>', var_export($claim , true));
			//exit;
		}
			/* not currently in use
			$intake_base_link = str_replace("main","util",Cellini::link('report',true,true));
			$this->assign('INTAKE_REPORT',$intake_base_link."report_id=17857&template_id=17859&encounter_id=".$encounter->get('id'));
			*/

		return $this->fetch(Cellini::getTemplatePath("/patient/" . $this->template_mod . "_encounter.html"));
	}

	/**
	 * Util function to check if we can rebill
	 *
	 * rule is: EOB payment has been made, There is an outstanding Balance, there is a secondary payer
	 */
	function _canRebill($encounterId) {
		$claim =& ClearhealthClaim::fromEncounterId($encounterId);

		ORDataObject::factory_include('Payment');
		$payments = Payment::fromForeignId($claim->get('id'));

		// check for EOB payment
		if (count($payments) > 0)  {

			$encounter =& ORDataObject::factory('Encounter',$encounterId);

			// check for an outstanding balance
			$status = $claim->accountStatus($encounter->get('patient_id'),$encounterId);
			if ($status['total_balance'] > 0) {

				// check for a secondary payer

				ORDataObject::factory_include('InsuredRelationship');
				$payers = InsuredRelationship::fromPersonId($encounter->get('patient_id'));
				if (count($payers) > 1) {
					return true;
				}
			}
		}

		return false;
	}

	function encounter_action_process($encounter_id=0) {
		if (isset($_POST['saveCode'])) {
			$this->coding->update_action_process();
			return;
		}


		$encounter =& ORDataObject::factory('Encounter',$encounter_id,$this->get('patient_id'));
		$encounter->populate_array($_POST['encounter']);

		if (isset($_POST['select_payer'])) {
			$encounter->persist();
			return;
		}
		
				
		$encounter->persist();
		$this->encounter_id = $encounter->get('id');

		if (isset($_POST['encounterDate']) && !empty($_POST['encounterDate']['date'])) {
			$this->encounter_date_id = $_POST['encounterDate']['encounter_date_id'];
			$encounterDate =& ORDataObject::factory('EncounterDate',$this->encounter_date_id,$this->encounter_id);
			$encounterDate->populate_array($_POST['encounterDate']);
			$encounterDate->persist();
			$this->encounter_date_id = $encounterDate->get('id');
		}
		if (isset($_POST['encounterValue']) && !empty($_POST['encounterValue']['value'])) {
			$this->encounter_value_id = $_POST['encounterValue']['encounter_value_id'];
			$encounterValue =& ORDataObject::factory('EncounterValue',$this->encounter_value_id,$this->encounter_id);
			$encounterValue->populate_array($_POST['encounterValue']);
			$encounterValue->persist();
			$this->encounter_value_id = $encounterValue->get('id');
		}
		if (isset($_POST['encounterPerson']) && !empty($_POST['encounterPerson']['person_id'])) {
			$this->encounter_person_id = $_POST['encounterPerson']['encounter_person_id'];
			$encounterPerson =& ORDataObject::factory('EncounterPerson',$this->encounter_person_id,$this->encounter_id);
			$encounterPerson->populate_array($_POST['encounterPerson']);
			$encounterPerson->persist();
			$this->encounter_person_id = $encounterPerson->get('id');
		}
		if (isset($_POST['payment']) && !empty($_POST['payment']['amount'])) {
			$this->payment_id = $_POST['payment']['payment_id'];
			$payment =& ORDataObject::factory('Payment',$this->payment_id);
			$payment->set("encounter_id", $this->encounter_id);
			$payment->populate_array($_POST['payment']);
			$payment->persist();
			$this->payment_id = $payment->get('id');
		}

		if (isset($_POST['encounter']['close'])) {
			$patient =& ORDataObject::factory('Patient',$encounter->get('patient_id'));
			ORDataObject::Factory_include('InsuredRelationship');
			$relationships = InsuredRelationship::fromPersonId($patient->get('id'));

			if ($relationships == null) { 
				$this->messages->addMessage("This Patient has no Insurance Information, please add insurance information and try again <br>");
				return;
			}else{	
				$encounter->set("status","closed");	
				$encounter->persist();
				$this->_generateClaim($encounter);
			}
		}
		
		// If this is a rebill, pass it off to the rebill method
		if (isset($_POST['encounter']['rebill'])) {
			$encounter->set('status', 'closed');
			$encounter->persist();
			$this->rebill_encounter_action_process($encounter_id);
		}
	}
	
	
	/**
	 * Re-opens a claim and redirects back to the encounter view
	 *
	 * @param int
	 */
	function reopen_encounter_action_process($encounter_id) {
		$encounter =& ORDataObject::Factory('Encounter', $encounter_id);
		$encounter->set('status', 'open');
		$encounter->persist();
		
		header('Location: '.Cellini::link('encounter',true,true,$encounter_id));
		exit();
	}


	/**
	 * Rebill an claim
	 */
	function rebill_encounter_action_process($encounter_id) {

		$encounter =& ORDataObject::Factory('Encounter',$encounter_id);

		// setup freeb2
		$this->_includeFreeb2();
		$freeb2 = new C_FreeBGateway();

		// get the current clearhealth claim
		ORdataObject::factory_include('ClearhealthClaim');
		$claim =& ClearhealthClaim::fromEncounterId($encounter_id);
		$claimIdentifier = $claim->get('identifier');
		

		// get the current revision of the freeb2 claim
		$currentRevision = $freeb2->maxClaimRevision($claimIdentifier);

		// open current claim forcing a revision, its a clean revision
		$revision = $freeb2->openClaim($claimIdentifier, $currentRevision, "P", true);
		
		// resend all the data
		// get the objects were going to need
		$patient =& ORDataObject::factory('Patient',$encounter->get('patient_id'));
		ORDataObject::Factory_include('InsuredRelationship');
		$relationships = InsuredRelationship::fromPersonId($patient->get('id'));

		if ($relationships == null) { 
			$this->messages->addMessage("This Patient has no Insurance Information to rebill, please add insurance information and try again <br>");
			return;
		}	
		
		$currentPayments = $claim->summedPaymentsByCode();
		
		$cd =& ORDataObject::Factory('CodingData');
		$codes = $cd->getCodeList($encounter->get('id'));

		$feeSchedule = ORDataObject::factory('FeeSchedule',$encounter->get('current_payer'));

		// add claimlines
		foreach($codes as $parent => $data) {

			$claimline = array();
			$claimline['date_of_treatment'] = $encounter->get('date_of_treatment');
			$claimline['procedure'] = $data['code'];
			$claimline['modifier'] = $data['modifier'];
			$claimline['units'] = $data['units'];
			$claimline['amount'] = $feeSchedule->getFeeFromCodeId($data['code_id']);
			$mapped_code=$feeSchedule->getMappedCodeFromCodeId($data['code_id']);
			//echo "<br>CPatient Code ".$data['code_id']." maps to $mapped_code<br>";
			if(strlen($mapped_code)>0){// then there is a mapped code which we should use.
				$claimline['procedure']=$mapped_code;
			}

			$claimline['diagnoses'] = array();
			if (isset($currentPayments[$data['code']])) {
				$claimline['amount_paid'] = $currentPayments[$data['code']]['paid'];
			}
			
			$childCodes = $cd->getChildCodes($data['coding_data_id']);
			foreach($childCodes as $val) {
				$claimline['diagnoses'][] = $val['code'];
			}
			if (!$freeb2->registerData($claimIdentifier,'Claimline',$claimline)) {
				trigger_error("Unable to register claimline - ". print_r($freeb2->claimLastError($claim_identifier),true));
			}

			// rewrite ar if needed
			if (isset($currentPayments[$data['code']])) {
				$cp = $currentPayments[$data['code']];

				if ($cp['carry'] > 0 && $claimline['amount'] > $data['fee']) {
					$rcd =& ORDataObject::factory('CodingData',$data['coding_data_id']);
					$rcd->set('fee',$claimline['amount']);
					$rcd->persist();
				}
			}
		}

		$this->_registerClaimData($freeb2,$encounter,$claimIdentifier);

		header('Location: '.Cellini::link('encounter',true,true,$encounter_id));
		exit();
	}

	function _movePayer($program_order,$row) {
		$ret = "";
		if ($program_order > 1) {
			$ret .= '<a href="'.Cellini::ManagerLink('moveInsuredRelationshipUp',$this->get('patient_id')).'id='.$row['insured_relationship_id'].
			'&process=true"><img src="'.$this->base_dir.'images/stock/s_asc.png" border=0></a>';
		}
		else {
			$ret .= "<img src='{$this->base_dir}images/stock/blank.gif' width=12 height=9>";
		}
		if ($program_order < $this->payerCount) {
			$ret .= '<a href="'.Cellini::ManagerLink('moveInsuredRelationshipDown',$this->get('patient_id'))
			.'id='.$row['insured_relationship_id'].'&process=true"><img src="'.$this->base_dir.'images/stock/s_desc.png" border=0></a>';
		}
		else {
			$ret .= "<img src='{$this->base_dir}images/stock/blank.gif' width=12 height=9>";
		}
		$ret .=$program_order;
		return $ret;
	}

	function update_action($foreign_id = 0, $parent_id = 0) {
		$this->coding_parent_id = $parent_id;
		return $this->encounter_action_edit($this->get('encounter_id'));
	}

	function _includeFreeb2() {
		//TODO make these respect the config.php values
		require_once(APP_ROOT . "/freeb2/local/controllers/C_FreeBGateway.class.php");
		require_once(APP_ROOT . "/freeb2/local/ordo/FBCompany.class.php");
		require_once(APP_ROOT . "/freeb2/local/ordo/FBPerson.class.php");
		require_once(APP_ROOT . "/freeb2/local/ordo/FBAddress.class.php");
		require_once(APP_ROOT . "/freeb2/local/ordo/FBBillingContact.class.php");
		require_once(APP_ROOT . "/freeb2/local/ordo/FBPractice.class.php");
		require_once(APP_ROOT . "/freeb2/local/ordo/FBBillingFacility.class.php");
		require_once(APP_ROOT . "/freeb2/local/ordo/FBReferringProvider.class.php");
		require_once(APP_ROOT . "/freeb2/local/ordo/FBResponsibleParty.class.php");
		require_once(APP_ROOT . "/freeb2/local/ordo/FBSubscriber.class.php");
		require_once(APP_ROOT . "/freeb2/local/ordo/FBSupervisingProvider.class.php");
		require_once(APP_ROOT . "/freeb2/local/ordo/FBTreatingFacility.class.php");
		require_once(APP_ROOT . "/freeb2/local/ordo/FBProvider.class.php");
		require_once(APP_ROOT . "/freeb2/local/ordo/FBClaim.class.php");
		require_once(APP_ROOT . "/freeb2/local/ordo/FBClaimline.class.php");
		require_once(APP_ROOT . "/freeb2/local/ordo/FBClearingHouse.class.php");
		require_once(APP_ROOT . "/freeb2/local/ordo/FBPatient.class.php");
		require_once(APP_ROOT . "/freeb2/local/ordo/FBPayer.class.php");
	}

	function _generateClaim(&$encounter,$claim = false) {
		$this->_includeFreeb2();

		$freeb2 = new C_FreeBGateway();
		
		// get the objects were going to need
		$patient =& ORDataObject::factory('Patient',$encounter->get('patient_id'));

		ORDataObject::Factory_include('InsuredRelationship');
		$relationships = InsuredRelationship::fromPersonId($patient->get('id'));

		if ($relationships == null) { 
			$this->messages->addMessage("This Patient has no Insurance Information to generate the claim, please add insurance information and try again <br>");
			return;
		}	
		

		$payment =& ORDataObject::factory('Payment');
		$payment_ds = $payment->paymentsFromEncounterId($encounter->get('id'));
		$payment_ds->clearFilters();
		$payments = $payment_ds->toArray();

		$cd =& ORDataObject::Factory('CodingData');
		$codes = $cd->getCodeList($encounter->get('id'));

		if (count($codes) == 0) {
			$this->messages->addMessage('This encounter had no claim lines so no claim was billed');
			return;
		}

		//create totals paid as of now and total billed
		$total_paid = 0.00;
		$total_billed = 0.00;
		
		// create claim entity on clearhealh side
		$claim =& ORDataObject::Factory('ClearhealthClaim');
		$claim->set('encounter_id',$encounter->get('id'));
		$claim->persist();
		
		//set the existing payments on the encounter to be part of this claim
		foreach ($payments as $payment_info) {
			$pmnt = ORDataObject::factory("Payment");
			$pmnt->populate_array($payment_info);
			$pmnt->set("foreign_id",$claim->get("claim_id"));
			$pmnt->persist();
			$total_paid += $payment_info['amount'];

			// payments have no claimline yet so lets create one for them applying the values to codes
			$currentPayments = $claim->summedPaymentsByCode();

			$toApply = $pmnt->get('amount');
			if ($toApply > 0) {
				foreach($codes as $code) {
					$fee = $code['fee'];
					if (isset($currentPayments[$code['code']])) {
						$fee = $fee - $currentPayments[$code['code']]['paid'];
					}

					if ($fee > 0) {
						if ($fee > $toApply) {
							$paid = $toApply;
						}
						else {
							$paid = $fee;
						}
						$toApply = $toApply - $paid;

						$claimline =& ORDataObject::Factory('PaymentClaimline');
						$claimline->set('payment_id',$pmnt->get('id'));
						$claimline->set('code_id',$code['code_id']);
						$claimline->set('paid',$paid);
						$claimline->set('writeoff',0);
						$claimline->set('carry',$fee-$paid);
						$claimline->persist();
					}
				}
			}

		}

		
		// generate a claim identifier from patient and encounter info
		$claim_identifier = $claim->get('id').'-'.$patient->get('record_number').'-'.$encounter->get('id');

		// open the claim
		if (!$freeb2->openClaim($claim_identifier)) {
			trigger_error("Unable to open claim: $claim_identifier - ".$freeb2->claimLastError($claim_identifier));
		}
		
		// add claimlines
		$currentPayments = $claim->summedPaymentsByCode();

		$feeSchedule = ORDataObject::factory('FeeSchedule',$encounter->get('current_payer'));

		foreach($codes as $parent => $data) {

		//echo "Debug: C_Patient<br>";
		//var_export($data); echo "<br>";		

			$claimline = array();
			$claimline['date_of_treatment'] = $encounter->get('date_of_treatment');
			$claimline['procedure'] = $data['code'];
			$claimline['modifier'] = $data['modifier'];
			$claimline['units'] = $data['units'];
			$claimline['amount'] = $data['fee'];
			$mapped_code=$feeSchedule->getMappedCodeFromCodeId($data['code_id']);
		//	echo "<br>CPatient Code ".$data['code_id']." maps to $mapped_code<br>";
			if(strlen($mapped_code)>0){// then there is a mapped code which we should use.
				$claimline['procedure']=$mapped_code;
			}
			

			$total_billed += $data['fee'];
			if (isset($currentPayments[$data['code']])) {
				$claimline['amount_paid'] = $currentPayments[$data['code']]['paid'];
			}
			$claimline['diagnoses'] = array();
			
			
			$childCodes = $cd->getChildCodes($data['coding_data_id']);
			foreach($childCodes as $val) {
				$claimline['diagnoses'][] = $val['code'];
			}
			if (!$freeb2->registerData($claim_identifier,'Claimline',$claimline)) {
				trigger_error("Unable to register claimline - ". print_r($freeb2->claimLastError($claim_identifier),true));
			}
		}

		// store id in clearhealth
		$claim->set('identifier',$claim_identifier);
		$claim->set("total_paid",$total_paid);
		$claim->set('total_billed',$total_billed);
		$claim->persist();

		$this->_registerClaimData($freeb2,$encounter,$claim_identifier);
	}

	function _registerClaimData(&$freeb2,&$encounter,$claim_identifier) {
		// get the objects were going to need
		$patient =& ORDataObject::factory('Patient',$encounter->get('patient_id'));
		ORDataObject::Factory_include('InsuredRelationship');
		$relationships = InsuredRelationship::fromPersonId($patient->get('id'));

		if ($relationships == null) { 
			$this->messages->addMessage("This Patient has no Insurance Information to register the claim data, please add insurance information and try again <br>");
			return;
		}	
		

		$provider =& ORDataObject::factory('Provider',$encounter->get('treating_person_id'));
		if ($provider->get('id') != $provider->get('bill_as')) {
			$bill_as = $provider->get('bill_as');
			unset($provider);
			$provider =& ORDataObject::factory('Provider',$bill_as);
		}




		$facility =& ORDataObject::factory('Building',$encounter->get('building_id'));

		// register patient data
		//Debug:
		//echo "Debug:C_Patient.class".var_export($patient->toArray());
		$patientData = $this->_cleanDataArray($patient->toArray());
		if (!$freeb2->registerData($claim_identifier,'Patient',$patientData)) {
			trigger_error("Unable to register patient data - ".$freeb2->claimLastError($claim_identifier));
		}

		// register subscriber data
		foreach($relationships as $r) {
			$data = $r->toArray();
			$tmp = $this->_cleanDataArray($data['subscriber']);
			unset($data['subscriber']);
			$data = array_merge($data,$tmp);
			//echo "C_Patient subscriber data:<br>".var_export($data);
			$freeb2->registerData($claim_identifier,'Subscriber',$data);
		}

		// register payers
		$payerList = array();
		$clearingHouseData = false;

		if ((int)$encounter->get('current_payer') > 0) {

			// only change order if its not correct
			if ($relationships[0]->get('insurance_program_id') != $encounter->get('current_payer')) {
				// find the index to move to the top

				foreach($relationships as $key => $val) {
					if ($val->get('insurance_program_id') == $encounter->get('current_payer')) {
						$r = $val;
						$id = $key;
						break;
					}
				}
				unset($relationships[$id]);
				array_unshift($relationships,$r);

			}
		}

		$defaultProgram = false;
		foreach($relationships as $r) {
			$program =& ORDataObject::factory('InsuranceProgram',$r->get('insurance_program_id'));
			if ($defaultProgram == false) {
				$defaultProgram =& ORDataObject::factory('InsuranceProgram',$r->get('insurance_program_id'));
			}

			if (!isset($payerList[$program->get('company_id')])) {
				$payerList[$program->get('company_id')] = true;
				$data = $program->toArray();
				$data = $this->_cleanDataArray($data['company']);
				$data['identifier'] = $data['name'];
				//echo "C_Patient payer";
				//var_export($data); echo "<br>";
				//flush();
				$freeb2->registerData($claim_identifier,'Payer',$data);
				if ($clearingHouseData === false) {
					$clearingHouseData = $data;
				}
			}
		}

		// register provider
		$providerData = $this->_cleanDataArray($provider->toArray());

		// add in x12 fields from default program
	//	$x12 = array('x12_sender_id','x12_receiver_id','x12_version');


	/*	$providerData['sender_id'] = $defaultProgram->get('x12_sender_id');
		$providerData['receiver_id'] = $defaultProgram->get('x12_receiver_id');
		$providerData['x12_version'] = $defaultProgram->get('x12_version');
*/
		// Set secondary identifier
		$providerPerson =& $provider->get('person');
		$extraIdentifiers =& $providerPerson->identifierList();
		if (count($extraIdentifiers->toArray()) > 0) {
			$i = 2;
			foreach ($extraIdentifiers->toArray() as $extraIdentifier) {
				$providerData["identifier_{$i}"]      = $extraIdentifier["identifier"];
				$providerData["identifier_type_{$i}"] = $extraIdentifier["identifier_type"];
				$i++;
			}
		}
		// There were no extra identifiers
		else {
			
		}
		
		if (!$freeb2->registerData($claim_identifier,'Provider',$providerData)) {
			trigger_error("Unable to register provider data - ".$freeb2->claimLastError($claim_identifier));
		}


		// register practice
		$practice =& ORDataObject::factory('Practice',$facility->get('practice_id'));
		$practiceData = $this->_cleanDataArray($practice->toArray());
		//printf('<pre>%s</pre>', var_export($practiceData , true));
		//echo "C_Patient practicedata";

			$practiceData['sender_id'] = $defaultProgram->get('x12_sender_id');
			$practiceData['receiver_id'] = $defaultProgram->get('x12_receiver_id');
			$practiceData['x12_version'] = $defaultProgram->get('x12_version');

		//var_export($practiceData); echo "<br>";
		if (!$freeb2->registerData($claim_identifier,'Practice',$practiceData)) {
			trigger_error("Unable to register practice data - ".$freeb2->claimLastError($claim_identifier));
		}

		// register treating facility
		$facilityData = $this->_cleanDataArray($facility->toArray());

		// check for an overriding identifier
		$bpi =& ORDAtaObject::factory('BuildingProgramIdentifier',$facility->get('id'),$defaultProgram->get('id'));
		if ($bpi->_populated) {
			$facilityData['identifier'] = $bpi->get('identifier');
		}
		
		if (!$freeb2->registerData($claim_identifier,'TreatingFacility',$facilityData)) {
			trigger_error("Unable to register treating facility data - ".$freeb2->claimLastError($claim_identifier));
		}
	
		$encounter_id=$encounter->get('id');

		// Add Encounter People....

		$EncounterPeople =& ORDataObject::factory('EncounterPerson');
		$encounterPeopleArray=$EncounterPeople->encounterPersonListArray($encounter_id);
	
		foreach($encounterPeopleArray as $encounter_person_id){	
			$ep =& ORDataObject::factory('EncounterPerson',$encounter_person_id,$encounter_id);
			$eptl = $encounter->_load_enum("encounter_person_type",false);
			$eptl = array_flip($eptl);
			$ept=$eptl[$ep->get('person_type')];
			
			$eptn = $ep->personTypeName();
			if (!$eptn) {
				trigger_error("Unable to find person type for encountner person with id: " . $EncounterPerson->get('person_id'));
				continue;	
			}
			
			//person based object	
			$pbo =& ORDataObject::factory($eptn, $ep->get('person_id'));
			$pbo_data = $this->_cleanDataArray($pbo->toArray());
			//var_dump($pbo_data);

			if (!$freeb2->registerData($claim_identifier,$ept,$pbo_data)) {
				trigger_error("Unable to encounter person data - ".$freeb2->claimLastError($claim_identifier));
			}
		}
		// End Encounter People

		// Encounter Values, 
		$EncounterValues =& ORDataObject::factory('EncounterValue');
		$encounterValueArray=$EncounterValues->encounterValueListArray($encounter_id);
		$ev_enum = $EncounterValues->_load_enum("encounter_value_type");
		$ev_enum = array_flip($ev_enum);
		$ClaimData = array();
	
		foreach($encounterValueArray as $encounter_value_id){
			$EncounterValue =& ORDataObject::factory('EncounterValue',$encounter_value_id,$encounter_id);
			$ev_name = $ev_enum[$EncounterValue->get('value_type')];
			$ClaimData[$ev_name] = $EncounterValue->get('value');
		}
		//var_dump($ClaimData);
		if (!$freeb2->registerData($claim_identifier,'Claim',$ClaimData)) {
			trigger_error("Unable to register Claim data - ".$freeb2->claimLastError($claim_identifier));
		}

		// register responsible party - patient
		if (!$freeb2->registerData($claim_identifier,'ResponsibleParty',$patientData)) {
			trigger_error("Unable to register responsible party data - ".$freeb2->claimLastError($claim_identifier));
		}

		// register biling facility - practice
		if (!$freeb2->registerData($claim_identifier,'BillingFacility',$practiceData)) {
			trigger_error("Unable to register billing facility data - ".$freeb2->claimLastError($claim_identifier));
		}
		
		// register biling facility - practice
		if (!$freeb2->registerData($claim_identifier,'BillingContact',$practiceData)) {
			trigger_error("Unable to register billing contact data - ".$freeb2->claimLastError($claim_identifier));
		}


		// register clearinghouse - payer
//		if (!$freeb2->registerData($claim_identifier,'ClearingHouse',$clearingHouseData)) {
//			trigger_error("Unable to register clearing house data - ".$freeb2->claimLastError($claim_identifier));
//		}

		// close the claim
		/*if (!$freeb2->closeClaim($claim_identifier,1)) {
			trigger_Error("Failed to close claim:  $claim_identifier");
		}*/


	}

	//add javadocs to say that this is pass through...
	function delete_claimline_action_process($parent_id,$encounter_id) {

		$encounter =& ORDataObject::factory('Encounter',$encounter_id,$this->get('patient_id'));
		if($encounter->get('status') === "open"){
			//TODO this disables the delete function on closed encounters
			//TODO the template should not even display the X on a closed claim.
			$this->coding->delete_claimline($parent_id);
		}
	
		header("Location:" . Cellini::link("encounter", true, true, $encounter_id));
		$this->_state=false;

	}

	function _cleanDataArray($data) {
		if (isset($data['date_of_birth'])) {
			$data['dob'] = $data['date_of_birth'];
		}
		if (isset($data['address']['postal_code'])) {
			$data['address']['zip'] = $data['address']['postal_code'];
		}

		if (isset($data['home_phone'])) {
	// TODO.. there should be some kind of "billing phone number" flag or something...
			$data['phone_number'] = $data['home_phone'];
			unset($data['home_phone']);
		}
		if (isset($data['gender'])) { 
			$data['gender'] = substr($data['gender'],0,1);
		}
		if (isset($data['address'])) {
			unset($data['address']['id']);
			unset($data['address']['name']);
			unset($data['address']['postal_code']);
			unset($data['address']['region']);

			/*if (isset($data['address']['state']) && preg_match('/^[0-9]+$/',$data['address']['state'])) {
				$e =& ORDataObject::factory('Enumeration');
				$data['address']['state'] = $e->enumLookup('state',$data['address']['state']);
			}*/
		}
		if (isset($data['payer_type'])) {
			$payer = ORDataObject::factory("InsuranceProgram");
			$pt_enum = $payer->_load_enum("PayerType");
			$data['payer_type'] = $pt_enum[$data['payer_type']];
		}
		
		unset($data['person_id']);
		unset($data['type']);
		return $data;
	}

	function summary_report_action() {
		$patient_id = $this->get('patient_id');
		if (!$patient_id) {
			return "A Patient must be selected before running the patient summary report";
		}
		

		// register data for selecting sections
		$sections = array();

		// demographic sections are static
		$sections['Demographics'] = array(
			array('display'=>'Basic Demographics','id'=>'bd','selected'=>true),
			array('display'=>'Phone Numbers','id'=>'pn','selected'=>true),
			array('display'=>'Addresses','id'=>'a','selected'=>true),
			array('display'=>'Payers','id'=>'p','selected'=>true),
			array('display'=>'Related People','id'=>'rp','selected'=>true),
			array('display'=>'Name History','id'=>'nh','selected'=>true),
			array('display'=>'Statistics','id'=>'s','selected'=>true),
		);

		$fd =& ORDataObject::factory('FormData');

		// encounter information
		$sections['Encounters'] = array();
		$encounter =& ORDataObject::factory('Encounter');
		$eds =& $encounter->encounterList($patient_id);
		for($eds->rewind(); $eds->valid(); $eds->next()) {
			$row = $eds->get();
			$sections['Encounters'][$row['encounter_id']] = 
				array('display' => "$row[encounter_reason] on $row[date_of_treatment]",'id'=>$row['encounter_id']);

			$fds =& $fd->dataListByExternalId($row['encounter_id']);

			for($fds->rewind(); $fds->valid(); $fds->next()) {
				$r = $fds->get();
				$sections['Encounters'][$row['encounter_id']]['Forms'][] = 
					array('id'=>$r['form_data_id'],'display'=>"$r[name] completed on $r[last_edit]");
			}
		}


		// patient forms
		$sections['Forms'] = array();
		$fds =& $fd->dataListByExternalId($patient_id);

		for($fds->rewind(); $fds->valid(); $fds->next()) {
			$row = $fds->get();
			$sections['Forms'][] = array('date'=>$row['last_edit'],'name'=>$row['name'],'id'=>$row['form_data_id'],'display'=>"$row[name] completed on $row[last_edit]");
		}

		$this->assign('sections',$sections);


		$patient =& ORDataObject::factory('Patient',$patient_id);
		$this->assign_by_ref('patient',$patient);

		return $this->fetch(Cellini::getTemplatePath("/patient/" . $this->template_mod . "_summary_report.html"));
	}

	function summary_report_action_process() {
		$data = array();

		foreach($_POST['sections'] as $section => $d) {
			$data[$section] = array();
			var_dump($section,$d);

			switch($section) {
				case 'Demographics':
					$data[$section] = $this->_summaryReportDemo($d);
					break;
				case 'Encounters':
					break;
				case 'Forms':
					break;
			}



		}
		$this->assign('data',$data);
	}	

	function _summaryReportDemo($sections) {
		$patient_id = $this->get('patient_id');
		$ret = array();
		foreach($sections as $section => $value) {
			if ($value == 1) {
				switch($section) {
				case 'bd':
					$patient =& ORDataObject::factory('Patient',$patient_id);
					$ret['Basic Demographics']['Last Name'] = $patient->get('last_name');
					$ret['Basic Demographics']['First Name'] = $patient->get('first_name');
					$ret['Basic Demographics']['Record Number'] = $patient->get('record_number');
					$ret['Basic Demographics'][$patient->get('print_identifier_type')] = $patient->get('identifier');
					$ret['Basic Demographics']['Date of Birth'] = $patient->get('date_of_birth');
					$ret['Basic Demographics']['Gender'] = $patient->get('print_gender');
					$ret['Basic Demographics']['Marital Status'] = $patient->get('print_marital_status');
					$ret['Basic Demographics']['Default Provider'] = $patient->get('print_default_provider');
					break;
				case 'pn':
					$number =& ORDataObject::factory('PersonNumber');
					$list = $number->numberList($patient_id);
					$ret['Phone Numbers']['table'] = array('Type','Number','Notes','Do Not Call?');

					foreach($list as $val) {
						$row = array();
						$row['Type'] = $val['number_type'];
						$row['Number'] = $val['number'];
						$row['Notes'] = $val['notes'];
						$row['Do Not Call?'] = $val['active'] ? 'no':'yes';
						$ret['Phone Numbers'][] = $row;
					}
					break;
				case 'a':
					$ret['Addresses']['table'] = array('Type','Name','Address','City','State','Zip','Notes');
					$address =& ORDataObject::Factory('PersonAddress');
					$list = $address->addressList($patient_id);

					foreach($list as $val) {
						$row = array();
						$row[] = $val['type'];
						$row[] = $val['name'];
						$row[] = $val['line1']."<br>".$val['line2'];
						$row[] = $val['city'];
						$row[] = $val['state'];
						$row[] = $val['postal_code'];
						$row[] = nl2br($val['notes']);
						$ret['Addresses'][] = $row;
					}
					break;
				case 'p':

					break;
				}
			}
		}
		return $ret;
	}
}
?>
