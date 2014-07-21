<?php
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;
/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RMQForm extends CFormModel
{
        /** @var string $queue */
	public $queue;
        /** @var string $text */
	public $text;

	/**
	 * Declares the validation rules.
	 * The rules state that email and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return [
			// queue and text are required
			['queue, text', 'required', 'on'=>['create']],

			['queue, text', 'safe', 'on'=>[
                                                        'search',
                                                        'delete',
                                                        'queue'
                                                ]
                        ],
		];
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return [
			'queue'=>'Queue',
			'text'=>'Message',
		];
	}

        public function createQueue()
        {
                try{

                    $connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
                    $channel = $connection->channel();
                    $channel->queue_declare($this->queue, false, false, false, false);

                    $msg = new AMQPMessage($this->text);
                    $channel->basic_publish($msg, '', $this->queue);

                    $channel->close();
                    $connection->close();
                    return true;

                } catch (Exception $exc) {
                        return $exc->getTraceAsString();
                }
        }

        public function search()
        {

                if (!$this->queue) return false;

                try{

                    $connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
                    $channel = $connection->channel();

                    $dataProvider = $channel->basic_get($this->queue);

                    if ($dataProvider !== null)
                        $channel->basic_ack($dataProvider->delivery_info['delivery_tag']);

                    $channel->close();
                    $connection->close();

                    return $dataProvider;

                } catch (Exception $exc) {
                        return $exc->getTraceAsString();
                }

        }

        public function delete()
        {
                if (!$this->queue) return false;

                try{

                    $connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
                    $channel = $connection->channel();
                    $isDeleted = $channel->queue_delete($this->queue);

                    $channel->close();
                    $connection->close();

                    return $isDeleted;
                } catch (Exception $exc) {
                        return $exc->getTraceAsString();
                }
        }
}
