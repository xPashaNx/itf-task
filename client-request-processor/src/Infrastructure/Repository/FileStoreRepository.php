<?php

declare(strict_types=1);

namespace ItfTask\Processor\Infrastructure\Repository;

class FileStoreRepository implements RepositoryInterface
{
	private string $filePath;
	private string $filename;

	public function __construct(string $filePath, string $filename)
	{
		$this->filePath = $filePath;
		$this->filename = $filename;
	}

	public function save(array $data)
	{
		$file = $this->getFile();
		$fp = fopen($file, 'a');
		$result = fwrite($fp, $this->dataToFormat($data));
		if ($result !== false) {
			echo "Data saved to file: " . $file . "\n";
		} else {
			echo "Data didn't save to file: " . $file . "\n";
		}

		fclose($fp);
	}

	private function getFile(): string
	{
		return rtrim($this->filePath, '/') . DIRECTORY_SEPARATOR . $this->filename;
	}

	private function dataToFormat(array $data): string
	{
		return implode(" | ", $data) . "\n";
	}
}