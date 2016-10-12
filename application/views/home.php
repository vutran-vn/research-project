<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="container">
    <div id="home-website">
        <div id="project-name">
            Project: Develop a Web Application for Harvesting Cloud Services Information from the Web
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div id="supervisors">
                    <strong>Supervisor: </strong> <span>Dr. Farookh Hussain</span><br>
                    <strong>Co-supervisor: </strong> <span>Asma Alkalbani</span>
                </div>
            </div>
            <div class="col-md-6">
                <div id="students">
                    <strong>Student: </strong>
                    <table class="table" style="width: auto">
                        <tbody>
                            <tr>
                                <td>Vu Tran</td>
                                <td>12120604</td>
                            </tr>
                            <tr>
                                <td>Yi-chan Tsai</td>
                                <td>11833858</td>
                            </tr>
                            <tr>
                                <td>My Ly Hoang</td>
                                <td>11935095</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <hr>
        <div class="features">
            <div id="target-website">Target website: <a href="http://www.serchen.com" target="_blank">http://www.serchen.com</a></div>
            <div>
                <strong>Datasets:</strong>
                <ul>
                    <li>Cloud services providers’ information (name, about, features, website)</li>
                    <li>Cloud services users’ reviews</li>
                </ul>
            </div>
            <div>
                <strong>Other features:</strong>
                <ul>
                    <li>Export the dataset into excel or HTML</li>
                    <li>Enable users to retrieve future website/web pages dynamically</li>
                </ul>
            </div>
        </div>
        <hr>
        <div id="actions">
            <div class="panel panel-success">
                <div class="panel-heading">Configuration</div>
                <div class="panel-body">
                    <div>
                        <a href="<?= site_url('config') ?>" class="btn btn-success">Config</a>
                    </div>
                    <hr>
                    <div>
                        <a href="<?= site_url('config/viewConfigJSON') ?>" class="btn btn-success">View Config Structure (JSON)</a>
                    </div>
                </div>
            </div>

            <div class="panel panel-info">
                <div class="panel-heading">Data</div>
                <div class="panel-body">
                    <div>
                        <a href="<?= site_url('data/viewSample') ?>" class="btn btn-info">View Sample Data</a>
                        <a href="<?= site_url('data/viewSiblings') ?>" class="btn btn-info">View URLs</a>
                        <a href="<?= site_url('config/viewData') ?>" class="btn btn-info">View Data</a>
                    </div>
                    <hr>
                    <div>
                        <a href="<?= site_url('data/viewSampleJSON') ?>" class="btn btn-info">View Sample Data (JSON)</a>
                        <a href="<?= site_url('data/viewSiblingsJSON') ?>" class="btn btn-info">View URLs (JSON)</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
