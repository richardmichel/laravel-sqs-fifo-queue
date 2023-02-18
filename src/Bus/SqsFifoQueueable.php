<?php

namespace MichiHelperSqs\LaravelSqsFifoQueue\Bus;

trait SqsFifoQueueable
{
    /**
     * The message group id the job should be sent to.
     *
     * @var string
     */
    public $messageGroupId;

    /**
     * The deduplication method to use for the job.
     *
     * @var string
     */
    public $deduplicator;

    /**
     * Set the desired message group id for the job.
     *
     * @param  string  $messageGroupId
     *
     * @return $this
     */
    public function onMessageGroup($messageGroupId)
    {
        $this->messageGroupId = $messageGroupId;

        return $this;
    }

    /**
     * Set the desired deduplication method for the job.
     *
     * @param  string  $deduplicator
     *
     * @return $this
     */
    public function withDeduplicator($deduplicator)
    {
        $this->deduplicator = $deduplicator;

        return $this;
    }

    /**
     * Remove the deduplication method from the job.
     *
     * @return $this
     */
    public function withoutDeduplicator()
    {
        return $this->withDeduplicator('');
    }


    /**
     *  method get job datafor sqs aws.
     *
     * @param  string  $job
     *
     * @return $data
     */
    public function getJobData()
    {
        $payload = json_decode($this->job->getRawBody());
        $command = unserialize($payload->data->command);
        return  $command->job;
    }
}
