<?PHP
#################################################################################
## Developed by Manifest Interactive, LLC                                      ##
## http://www.manifestinteractive.com                                          ##
## ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ ##
##                                                                             ##
## THIS SOFTWARE IS PROVIDED BY MANIFEST INTERACTIVE 'AS IS' AND ANY           ##
## EXPRESSED OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE         ##
## IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR          ##
## PURPOSE ARE DISCLAIMED.  IN NO EVENT SHALL MANIFEST INTERACTIVE BE          ##
## LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR         ##
## CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF        ##
## SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR             ##
## BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,       ##
## WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE        ##
## OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,           ##
## EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.                          ##
## ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ ##
## Author of file: Peter Schmalfeldt                                           ##
#################################################################################

/**
 * @category Apple Push Notification Service using PHP & MySQL
 * @package EasyAPNs
 * @author Peter Schmalfeldt <manifestinteractive@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link http://code.google.com/p/easyapns/
 */

/**
 * Begin Document
 */

// AUTOLOAD CLASS OBJECTS... YOU CAN USE INCLUDES IF YOU PREFER
if(!function_exists("__autoload")){ 
	function __autoload($class_name){
		require_once('classes/class_'.$class_name.'.php');
	}
}

// CREATE DATABASE OBJECT ( MAKE SURE TO CHANGE LOGIN INFO IN CLASS FILE )
$db = new DbConnect('localhost', 'root', 'qwerty', 'protube');
$db->show_errors();

// FETCH $_GET OR CRON ARGUMENTS TO AUTOMATE TASKS
$apns = new APNS($db);


/**
/*	ACTUAL SAMPLES USING THE 'Examples of JSON Payloads' EXAMPLES (1-5) FROM APPLE'S WEBSITE.
 *	LINK:  http://developer.apple.com/iphone/library/documentation/NetworkingInternet/Conceptual/RemoteNotificationsPG/ApplePushService/ApplePushService.html#//apple_ref/doc/uid/TP40008194-CH100-SW15
 */

///flush message first
//$apns->_flushMessage();



// APPLE APNS EXAMPLE 2
$apns->newMessage(915103, '2013-06-25 17:53:31'); // FUTURE DATE NOT APART OF APPLE EXAMPLE
$apns->addMessageAlert('Check out our new app');
$apns->addMessageBadge(5);
$apns->addMessageCustom('url', 'http://google.com');
$apns->addMessageCustom('title', 'iTubePro');
$apns->addMessageCustom('description', 'This is newly updated Pro version. So far so hot!!');
$apns->queueMessage();

//$apns->newMessage(2, '2010-01-01 00:00:00'); // FUTURE DATE NOT APART OF APPLE EXAMPLE
//$apns->addMessageAlert('Check out our new app', 'View');
//$apns->addMessageBadge(5);
//$apns->addMessageCustom('url', 'http://google.com');
//$apns->addMessageCustom('title', 'iTubePro');
//$apns->addMessageCustom('description', 'This is newly updated Pro version. So far so hot!!');
//$apns->queueMessage();
//
//$apns->newMessage(3, '2010-01-01 00:00:00'); // FUTURE DATE NOT APART OF APPLE EXAMPLE
//$apns->addMessageAlert('Check out our new app', 'View');
//$apns->addMessageBadge(5);
//$apns->addMessageCustom('url', 'http://google.com');
//$apns->addMessageCustom('title', 'iTubePro');
//$apns->addMessageCustom('description', 'This is newly updated Pro version. So far so hot!!');
//$apns->queueMessage();
//
//$apns->newMessage(4, '2010-01-01 00:00:00'); // FUTURE DATE NOT APART OF APPLE EXAMPLE
//$apns->addMessageAlert('Check out our new app', 'View');
//$apns->addMessageBadge(5);
//$apns->addMessageCustom('url', 'http://google.com');
//$apns->addMessageCustom('title', 'iTubePro');
//$apns->addMessageCustom('description', 'This is newly updated Pro version. So far so hot!!');
//$apns->queueMessage();

// SEND ALL MESSAGES NOW
$apns->processQueue();



?>
