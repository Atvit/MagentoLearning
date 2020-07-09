<?php


namespace LearningMagento\CustomCli\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Customer\Api\Data\CustomerInterfaceFactory;
use Magento\Customer\Api\CustomerRepositoryInterface;

class addCustomer extends Command
{
    const NAME = 'name';
    const EMAIL = 'email';

    protected $customerFactory;
    protected $customerRepository;

    public function __construct(
        CustomerInterfaceFactory $customerFactory,
        CustomerRepositoryInterface $customerRepository
    )
    {
        $this->customerFactory = $customerFactory;
        $this->customerRepository = $customerRepository;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('custom:customer:add')
            ->addArgument(
                self::NAME,
                InputArgument::REQUIRED,
                'Customer name'
            )->addArgument(
                self::EMAIL,
                InputArgument::REQUIRED,
                'Customer email'
            )
            ->setDescription('Custom command for add customer.');

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            /** @var \Magento\Customer\Api\Data\CustomerInterface $customer */
            $customer = $this->customerFactory->create();
            $customer->setEmail($input->getArgument(self::EMAIL));
            $customer->setFirstname($input->getArgument(self::NAME));
            $customer->setLastname("Doe");

            /** @var \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository */
            $this->customerRepository->save($customer);
        } catch (\Exception $e) {
            //
        }

        $output->writeln("Successfully added customer " . $input->getArgument(self::NAME));

    }
}
