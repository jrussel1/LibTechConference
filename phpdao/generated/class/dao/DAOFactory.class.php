<?php

/**
 * DAOFactory
 * @author: http://phpdao.com
 * @date: ${date}
 */
class DAOFactory{
	
	/**
	 * @return AttendanceTypeDAO
	 */
	public static function getAttendanceTypeDAO(){
		return new AttendanceTypeMySqlExtDAO();
	}

	/**
	 * @return CommitteeMemberDAO
	 */
	public static function getCommitteeMemberDAO(){
		return new CommitteeMemberMySqlExtDAO();
	}

	/**
	 * @return EventDAO
	 */
	public static function getEventDAO(){
		return new EventMySqlExtDAO();
	}

	/**
	 * @return EventActivityLevelDAO
	 */
	public static function getEventActivityLevelDAO(){
		return new EventActivityLevelMySqlExtDAO();
	}

	/**
	 * @return InstitutionDAO
	 */
	public static function getInstitutionDAO(){
		return new InstitutionMySqlExtDAO();
	}

	/**
	 * @return InstitutionTypeDAO
	 */
	public static function getInstitutionTypeDAO(){
		return new InstitutionTypeMySqlExtDAO();
	}

	/**
	 * @return PastAttendeeDAO
	 */
	public static function getPastAttendeeDAO(){
		return new PastAttendeeMySqlExtDAO();
	}

	/**
	 * @return PersonDAO
	 */
	public static function getPersonDAO(){
		return new PersonMySqlExtDAO();
	}

	/**
	 * @return PersonOfSessionDAO
	 */
	public static function getPersonOfSessionDAO(){
		return new PersonOfSessionMySqlExtDAO();
	}

	/**
	 * @return ReviewProposalsDAO
	 */
	public static function getReviewProposalsDAO(){
		return new ReviewProposalsMySqlExtDAO();
	}

	/**
	 * @return SectionDAO
	 */
	public static function getSectionDAO(){
		return new SectionMySqlExtDAO();
	}

	/**
	 * @return SessionDAO
	 */
	public static function getSessionDAO(){
		return new SessionMySqlExtDAO();
	}

	/**
	 * @return SessionStyleDAO
	 */
	public static function getSessionStyleDAO(){
		return new SessionStyleMySqlExtDAO();
	}

	/**
	 * @return SessionTagsDAO
	 */
	public static function getSessionTagsDAO(){
		return new SessionTagsMySqlExtDAO();
	}

	/**
	 * @return SessionTargetDAO
	 */
	public static function getSessionTargetDAO(){
		return new SessionTargetMySqlExtDAO();
	}

	/**
	 * @return TargetAudienceDAO
	 */
	public static function getTargetAudienceDAO(){
		return new TargetAudienceMySqlExtDAO();
	}

	/**
	 * @return WaitlistDAO
	 */
	public static function getWaitlistDAO(){
		return new WaitlistMySqlExtDAO();
	}

	/**
	 * @return MembersDAO
	 */
	public static function getMembersDAO(){
		return new MembersMySqlExtDAO();
	}

	/**
	 * @return SiteRegistrationDAO
	 */
	public static function getSiteRegistrationDAO(){
		return new SiteRegistrationMySqlExtDAO();
	}


}
?>